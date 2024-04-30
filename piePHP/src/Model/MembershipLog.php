<?php

namespace Model;

use Core\Entity;

class MembershipLog extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'membership_log';

    public function __construct()
    {
            parent::__construct();
    }

        /**
         * @param $data
         * @return false|string
         */
    public function createLog($data): false|string
    {
            return $this->insert($this->table, $data);
    }

        /**
         * @param $id
         * @return bool
         */
    public function deleteLog($id): bool
    {
            return $this->delete($this->table, 'id = ' . $id);
    }
}
