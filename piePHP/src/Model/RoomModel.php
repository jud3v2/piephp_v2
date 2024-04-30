<?php

namespace Model;

use Core\Entity;

class RoomModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'room';

    public function __construct()
    {
            parent::__construct();
    }
}
