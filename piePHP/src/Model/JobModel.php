<?php

namespace Model;

use Core\Entity;

class JobModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'job';

    public function __construct()
    {
            parent::__construct();
    }
}
