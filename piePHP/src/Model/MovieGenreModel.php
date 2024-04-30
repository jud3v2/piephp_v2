<?php

namespace Model;

use Core\Entity;

class MovieGenreModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'movie_genre';

    public function __construct()
    {
            parent::__construct();
    }

    public function createMovieGenre(array $data): false|string
    {
            return $this->insert($this->table, $data);
    }

    public function deleteMovieGenre(int $id): bool
    {
            return $this->delete($this->table, 'id_movie = ' . $id)->execute();
    }

        /**
         * @param $id
         * @param $data
         * @return bool
         */
    public function updateMovieGenre($id, $data): bool
    {
            $query = $this->update($this->table, $data, "id_movie = $id");
            return $query->execute();
    }
}
