<?php

namespace Model;

use Core\Entity;

class HistoryModel extends Entity
{
    protected string $table = "history";
    public function __construct()
    {
            parent::__construct();
    }

        /**
         * @param int|string $id
         * @return bool
         */
    public function getHistoryByUserId(int|string $id): bool
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->where('id = ' . $id)
                ->toSQL();

            return $this->query($sql)->execute();
    }

        /**
         * @param $data
         * @return false|string
         */
    public function createHistory($data): false|string
    {
            return $this->insert($this->table, $data);
    }

        /**
         * @param $id
         * @return bool
         */
    public function deleteHistory($id): bool
    {
            return $this->delete($this->table, 'id = ' . $id)
                ->execute();
    }
}
