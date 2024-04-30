<?php

namespace Core;

use Core\Bonus\QueryBuilder;
use PDO;
use PDOStatement;

class ORM extends DB
{
        /**
         * @var \Core\Bonus\QueryBuilder
         */
    private QueryBuilder $queryBuilder;

    public function __construct()
    {
            parent::__construct();
            $this->queryBuilder = new QueryBuilder();
    }

        /**
         * This function will fetch every row from the requested table
         * @param string $table
         * @return array|false
         */
    public function all(string $table): array|false
    {
            $sql = $this->queryBuilder
                ->from($table, $table[0])
                ->toSQL();

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
         * @param string $table
         * @param array $fields
         * @return false|string
         */
    public function create(string $table, array $fields): false|string
    {
            $sql = $this->queryBuilder
                ->from($table, '')
                ->insertQB($fields)
                ->setMode('insert')
                ->toSQL();

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $this->db->lastInsertId();
    }

        /**
         * @param string $table
         * @param array $fields
         * @param int $id
         * @return false|string
         */
    public function updateORM(string $table, array $fields, int $id): false|string
    {
            $sql = $this->queryBuilder
                ->from($table, '')
                ->where('id = ' . $id)
                ->updateQB($fields)
                ->setMode('update')
                ->toSQL();

            $stmt = $this->db->prepare($sql);
            return $stmt->execute();
    }

    public function deleteQB(string $table, int $id): bool
    {
            $sql = $this->queryBuilder
                ->from($table, '')
                ->where('id = ' . $id)
                ->setMode('delete')
                ->toSQL();

            $stmt = $this->db->prepare($sql);
            return $stmt->execute();
    }

        /**
         * This function will fetch one row from the requested table
         * @param string $table
         * @param int $id
         * @return array|false
         */
    public function read(string $table, int $id): array|false
    {
            $sql = $this->queryBuilder
                ->from($table, $table[0])
                ->where("id = $id")
                ->setMode("select")
                ->toSQL();

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        /**
         * This function will fetch one row from the requested table
         * @param string $table
         * @param array $param
         * @return array|false
         */
    public function findOne(string $table, array $param): array|false
    {
            $stmt = $this->getQB($param, $table);
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        /**
         * This function will generate a query based on the parameters passed
         * @param array $param by default an empty array
         * @param string $table
         * @return false|\PDOStatement
         */
    public function getQB(array $param, string $table): PDOStatement|false
    {
        if (isset($param['ORDER BY']) && isset($param['LIMIT']) && isset($param['WHERE'])) {
                $orderBy = explode(" ", $param['ORDER BY']);
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->where($param['WHERE'])
                    ->orderBy($orderBy[0], $orderBy[1])
                    ->limit($param['LIMIT'])
                    ->setMode('select')
                    ->toSQL();
        } elseif (isset($param['WHERE']) && isset($param['ORDER BY'])) {
                $orderBy = explode(" ", $param['ORDER BY']);
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->where($param['WHERE'])
                    ->orderBy($orderBy[0], $orderBy[1])
                    ->setMode('select')
                    ->toSQL();
        } elseif (isset($param['WHERE']) && isset($param['LIMIT'])) {
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->where($param['WHERE'])
                    ->limit($param['LIMIT'])
                    ->setMode('select')
                    ->toSQL();
        } elseif (isset($param['ORDER BY']) && isset($param['LIMIT'])) {
                $orderBy = explode(" ", $param['ORDER BY']);
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->orderBy($orderBy[0], $orderBy[1])
                    ->limit($param['LIMIT'])
                    ->setMode('select')
                    ->toSQL();
        } elseif (isset($param['WHERE'])) {
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->where($param['WHERE'])
                    ->setMode('select')
                    ->toSQL();
        } elseif (isset($param['ORDER BY'])) {
                $orderBy = explode(" ", $param['ORDER BY']);
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->orderBy($orderBy[0], $orderBy[1])
                    ->setMode('select')
                    ->toSQL();
        } elseif (isset($param['LIMIT'])) {
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->limit($param['LIMIT'])
                    ->setMode('select')
                    ->toSQL();
        } else {
                $sql = $this->queryBuilder
                    ->from($table, $table[0])
                    ->setMode('select')
                    ->toSQL();
        }

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
    }

        /**
         * This function will fetch every row from the requested table
         * @param string $table
         * @param array $param
         * @return array|false
         */
    public function findAll(string $table, array $param = []): array|false
    {
            $stmt = $this->getQB($param, $table);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
