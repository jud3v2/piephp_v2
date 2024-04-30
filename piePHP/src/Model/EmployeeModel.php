<?php

namespace Model;

use Core\Entity;

class EmployeeModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'employee';

    public function __construct()
    {
            parent::__construct();
    }
}
