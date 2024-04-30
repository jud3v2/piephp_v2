<?php

namespace Model;

use Core\Entity;

class MovieScheduleModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'movie_schedule';

    public function __construct()
    {
            parent::__construct();
    }
}
