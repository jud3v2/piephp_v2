<?php

namespace Core;

use PDO;

class DB
{
    protected PDO|null $db;
    public function __construct()
    {
            $this->db = new PDO('mysql:host=localhost;dbname=cinema', 'root', '1234');
    }

    public function query($sql, $params = []): false|\PDOStatement
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetch($sql, $params = []): mixed
    {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll($sql, $params = []): false|array
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data): false|string
    {
        $sql = "INSERT INTO $table (" . implode(',', array_keys($data)) . ") 
        VALUES (" . implode(',', array_fill(0, count($data), '?')) . ")";
        $this->query($sql, array_values($data));
        return $this->db->lastInsertId();
    }

    public function update($table, $data, $where): false|\PDOStatement
    {
        $sql = "UPDATE $table SET " . implode('=?,', array_keys($data)) . '=? WHERE ' . $where;
        return $this->query($sql, array_values($data));
    }

    public function delete($table, $where): false|\PDOStatement
    {
        $sql = "DELETE FROM $table WHERE $where";
        return $this->query($sql);
    }

    public function __destruct()
    {
        $this->db = null;
    }
}
