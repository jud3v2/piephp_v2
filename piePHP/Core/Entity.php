<?php

namespace Core;

use Core\Bonus\QueryBuilder;
use PDO;

abstract class Entity extends DB
{
        /**
         * @var string
         */
    protected string $table;

        /**
         * @var array
         */
    protected array $params = [];
        /**
         * @var \Core\Bonus\QueryBuilder
         */
    protected QueryBuilder $queryBuilder;

    protected int $mode = PDO::FETCH_OBJ;

    public function __construct()
    {
        parent::__construct();
        $this->queryBuilder = new QueryBuilder();
    }

        /**
         * @param int $id
         * @return mixed
         */
    public function getEntityById(int $id): mixed
    {
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
    }

        /**
         * @return array|false
         */
    public function getAllEntities(): array|false
    {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
    }

    public function deleteEntity(int $id): bool
    {
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
    }

        /**
         * @return bool
         */
    public function save(): bool
    {
        if (isset($this->params['id'])) {
                return $this->updateEntity($this->params['id'], $this->params);
        } else {
                return $this->createEntity($this->params);
        }
    }

    public function updateEntity(int $id, array $data): bool
    {
            $sql = "UPDATE $this->table SET ";
        foreach ($data as $key => $value) {
                $sql .= "$key = :$key, ";
        }
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
        foreach ($data as $key => $value) {
                $stmt->bindParam(":$key", $value);
        }
            return $stmt->execute();
    }

    public function createEntity(array $data): bool
    {
            $sql = "INSERT INTO $this->table (";
        foreach ($data as $key => $value) {
                $sql .= "$key, ";
        }
            $sql = substr($sql, 0, -2);
            $sql .= ") VALUES (";
        foreach ($data as $key => $value) {
                $sql .= ":$key, ";
        }
            $sql = substr($sql, 0, -2);
            $sql .= ")";
            $stmt = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
                $stmt->bindParam(":$key", $value);
        }
            return $stmt->execute();
    }

    protected function setParams(string $key, mixed $value): void
    {
            $this->params[$key] = $value;
    }


        /**
         * relation one to one
         * @param string $class
         * @param string|int $id
         * @param string $foreignKey
         * @return mixed
         */
    public function hasOne(string $class, string|int $id, string $foreignKey = 'id'): mixed
    {
        if (class_exists($class)) {
            if ($entity = $this->resolveEntity($class)) {
                    $sql = $this->queryBuilder
                        ->from($entity->table, $entity->table[0])
                        ->where("$foreignKey = $id")
                        ->toSQL();
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    return $stmt->fetch($this->mode);
            } else {
                    die("Cannot resolve entity $class");
            }
        } else {
                die("Class $class does not exist");
        }
    }

        /**
         * relation one to many
         * @param string $class
         * @param string|int $id
         * @param string $foreignKey
         * @return mixed
         */
    public function hasMany(string $class, string|int $id, string $foreignKey = 'id'): mixed
    {
        if (class_exists($class)) {
            if ($entity = $this->resolveEntity($class)) {
                $sql = $this->queryBuilder
                    ->from($entity->table, $entity->table[0])
                    ->where("$foreignKey = $id")
                    ->toSQL();
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll($this->mode);
            } else {
                    die("Cannot resolve entity $class");
            }
        } else {
                die("Class $class does not exist");
        }
    }

    public function belongsToMany(
        string $class,
        string $pivot,
        string $foreignKey,
        string $localKey,
        string $foreignKeyPivot,
        string $localKeyPivot
    ): mixed {
        if (class_exists($class)) {
            if ($entity = $this->resolveEntity($class)) {
                $sql = $this->queryBuilder
                    ->from($entity->table, $entity->table[0])
                    ->join($pivot, "$pivot.$foreignKeyPivot = $entity->table.$localKey")
                    ->where("$pivot.$localKeyPivot = $this->params[$foreignKey]")
                    ->toSQL();
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll($this->mode);
            } else {
                    die("Cannot resolve entity $class");
            }
        } else {
                die("Class $class does not exist");
        }
    }

        /**
         * Resolve entity
         * @param string $entity
         * @return mixed|object
         */
    private function resolveEntity(string $entity): mixed
    {
            return new $entity();
    }
}
