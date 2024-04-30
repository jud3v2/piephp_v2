<?php

namespace Model;

use Core\Entity;

class DistributorModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'distributor';

    public function __construct()
    {
            parent::__construct();
    }

        /**
         * @param array $data
         * @return string id of distributor
         */
    public function createDistributor(array $data): string
    {
            return $this->insert($this->table, $data);
    }

        /**
         * @return array|false
         */
    public function getAllDistributor(): false|array
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->toSQL();

            return $this->fetchAll($sql);
    }

        /**
         * @param string|int $id
         * @return mixed
         */
    public function getOneDistributor(string|int $id): mixed
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->where('id = :id')
                ->setParams('id', $id)
                ->toSQL();

            return $this->fetch($sql, ['id' => $id]);
    }

        /**
         * @param string|int $id
         * @param array $data
         * @return bool
         */
    public function updateDistributor(string|int $id, array $data): bool
    {
            $query = $this->update($this->table, $data, "id = $id");
            return $query->execute();
    }

        /**
         * @param string|int $id
         * @return bool
         */
    public function deleteDistributor(string|int $id): bool
    {
            $query = $this->delete($this->table, "id = $id");
            return $query->execute();
    }
}
