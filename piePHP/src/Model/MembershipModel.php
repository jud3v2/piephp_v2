<?php

namespace Model;

use Core\Entity;

class MembershipModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'membership';

    public function __construct()
    {
            parent::__construct();
    }
}
