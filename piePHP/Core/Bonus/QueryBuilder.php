<?php

namespace Core\Bonus;

use Core\DB;

class QueryBuilder extends DB
{
        /**
         * from table
         * @var string
         */
    private string $table;

        /**
         * order by
         * @var string[]
         */
    private array $order = [];

        /**
         * limit
         * @var int
         */
    private int $limit = 0;

        /**
         * offset for pagination
         * @var int|null
         */
    private int|null $offset = null;

        /**
         * where
         * @var string
         */
    private string $where;

        /**
         * @var string[]
         */
    private array $fields = ["*"];

        /**
         * @var array
         */
    private array $params = [];

        /**
         * @var string[]
         */
    private array $groupBys = [];

        /**
         * @var array
         */
    private array $joins = [];

        /**
         * @var array
         */
    private array $insertFields = [];

        /**
         * @var array
         */
    private array $updateFields = [];

        /**
         * @var string
         */
    private string $mode = 'select';

        /**
         * @var string[]
         */
    private array $acceptedModes = ['select', 'insert', 'update', 'delete'];

        /**
         * ORM constructor.
         * call parent constructor DB
         */
    public function __construct()
    {
            parent::__construct();
    }

        /**
         * from table
         * @param string $table
         * @param string $alias
         * @return $this
         */
    public function from(string $table, string $alias): QueryBuilder
    {
            $this->table = "$table $alias";
            return $this;
    }

        /**
         * order by
         * @param string $field
         * @param string $orderDirection
         * @return $this
         */
    public function orderBy(string $field, string $orderDirection): QueryBuilder
    {
            // ensure we are in uppercase
            $orderDirection = strtoupper($orderDirection);

        if (in_array($orderDirection, ['ASC', 'DESC'])) {
                $this->order[] = "$field $orderDirection";
        } else {
                $this->order[] = $field;
        }

            return $this;
    }

        /**
         * group by
         * @param string ...$fields
         * @return $this
         */
    public function groupBy(string ...$fields): QueryBuilder
    {
            $this->groupBys = $fields;
            return $this;
    }

        /**
         * limit
         * @param int $limit
         * @return $this
         */
    public function limit(int $limit): QueryBuilder
    {
            $this->limit = $limit;
            return $this;
    }

        /**
         * offset for pagination
         * @param int $offset
         * @return $this
         */
    public function offset(int $offset): QueryBuilder
    {
            $this->offset = $offset;
            return $this;
    }


        /**
         * handle pagination
         * @param int $page
         * @return $this
         */
    public function page(int $page): QueryBuilder
    {
            return $this->offset($this->limit * ($page - 1));
    }

        /**
         * where clause
         * @param string $where
         * @return $this
         */
    public function where(string $where): QueryBuilder
    {
            $this->where = $where;
            return $this;
    }

        /**
         * assign parameters to the query
         * @param string $key
         * @param mixed $value
         * @return $this
         */
    public function setParams(string $key, mixed $value): QueryBuilder
    {
            $this->params[$key] = $value;
            return $this;
    }

        /**
         * select fields
         * @param string|array ...$fields
         * @return $this
         */
    public function select(string|array ...$fields): QueryBuilder
    {
        if (is_array($fields[0])) {
                $this->fields = $fields[0];
        }

        if ($this->fields === ['*']) {
                $this->fields = $fields;
        } else {
                $this->fields = array_merge($this->fields, $fields);
        }
            return $this;
    }

        /**
         * join tables
         * @param $table
         * @param $first
         * @param $operator
         * @param $second
         * @param $type
         * @return $this
         */
    public function join(string $table, string $first, string $operator, string $second, $type = 'INNER'): QueryBuilder
    {
            $this->joins[] = "$type JOIN $table ON $first $operator $second";
            return $this;
    }

        /**
         * fetch one row from your built query
         * @param string $field
         * @return string|null
         */
    public function fetchField(string $field): string|null
    {
            $query = $this->db->prepare($this->toSQL());
            $query->execute($this->params);
            $result = $query->fetch();
        if ($result === false) {
                return null;
        }
            return $query->fetch()[$field] ?? null;
    }

        /**
         * count the number of rows from your built query
         * @return int|null
         */
    public function count(): int|null
    {
            // clone the object to avoid side effects
            return (int) (clone $this)
                ->select('COUNT(*) as count')
                ->fetchField('count');
    }

    public function first(int $id)
    {
    }

    public function last($id)
    {
    }

        /**
         * @param array $fields
         * @return $this
         */
    public function updateQB(array $fields): QueryBuilder
    {
            $this->updateFields = $fields;
            return $this;
    }

    public function deleteQB()
    {
    }

        /**
         * This will prepare the query for inserting data
         * @param array $fields
         * @return $this
         */
    public function insertQB(array $fields): QueryBuilder
    {
            $this->insertFields = $fields;
            return $this;
    }


        /**
         * @param string $mode
         * @return $this
         */
    public function setMode(string $mode): QueryBuilder
    {
        if (!in_array($mode, $this->acceptedModes)) {
                throw new \InvalidArgumentException("Invalid mode $mode");
        }

        if ($mode === 'insert' && empty($this->insertFields)) {
                throw new \InvalidArgumentException("You cannot insert empty data");
        }

        if ($mode === 'update' && empty($this->updateFields)) {
                throw new \InvalidArgumentException("You cannot update without data");
        }

        if ($mode === 'update' && empty($this->where)) {
                throw new \InvalidArgumentException("You cannot update without a where clause");
        }

        if ($mode === 'delete' && empty($this->where)) {
                throw new \InvalidArgumentException("You cannot delete without a where clause");
        }

            $this->mode = $mode;
            return $this;
    }

        /**
         * Build your query and return it as a string
         * @return string
         */
    public function toSQL(): string
    {
            $fields = implode(', ', $this->fields);

        if ($this->mode === 'select') {
                    $query = "SELECT $fields FROM {$this->table}";
        }

        if ($this->mode === 'insert') {
                $fields = array_keys($this->insertFields);
                $placeholders = array_map(fn($field) => ":$field", $fields);
                $this->params = array_combine($placeholders, array_values($this->insertFields));

                $query = "INSERT INTO {$this->table} (" . implode(', ', array_keys($this->insertFields))
                    . ") VALUES (";

                $length = count($this->insertFields);
            foreach ($this->insertFields as $key => $value) {
                    $length--;
                if (is_string($value)) {
                    // tant que il y a des éléments dans le tableau
                    // on ajoute une virgule sinon on ajoute rien
                    $query .= $length === 0 ? "'$value'" : "'$value', ";
                } else {
                        $query .= $length === 0 ? $value : $value . ', ';
                }
            }

                $query .= ")";
        }

        if ($this->mode === 'update') {
                $fields = array_keys($this->updateFields);
                $placeholders = array_map(fn($field) => ":$field", $fields);
                $this->params = array_combine($placeholders, array_values($this->updateFields));

                /** @noinspection SqlWithoutWhere */
                $query = "UPDATE  {$this->table} SET ";

                $length = count($this->updateFields);
            foreach ($this->updateFields as $key => $value) {
                    $length--;
                if (is_string($value)) {
                    // tant que il y a des éléments dans le tableau
                    // on ajoute une virgule sinon on ajoute rien
                    $query .= $length === 0 ? "$key = '$value'" : "$key = '$value', ";
                } else {
                        $query .= $length === 0 ? "$key $value" : $key . $value . ', ';
                }
            }

                $query .= " WHERE {$this->where}";
        }

        if ($this->mode === 'delete') {
                $query = "DELETE FROM {$this->table} WHERE {$this->where}";
        }

        if (!empty($this->joins)) {
                $query .= ' ' . implode(' ', $this->joins);
        }

        if (!empty($this->where) && $this->mode !== 'insert' && $this->mode !== 'delete' && $this->mode !== 'update') {
                $query .= " WHERE $this->where";
        }

        if (!empty($this->groupBys)) {
                $query .= " GROUP BY " . implode(', ', $this->groupBys);
        }

        if (!empty($this->order)) {
                $query .= " ORDER BY " . implode(',  ', $this->order);
        }

        if ($this->limit > 0) {
                $query .= " LIMIT {$this->limit}";
        }

        if ($this->offset !== null) {
                $query .= " OFFSET {$this->offset}";
        }

            return $query;
    }
}
