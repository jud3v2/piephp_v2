<?php

namespace Model;

use Core\Entity;
use stdClass;

class GenreModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'genre';

    public function __construct()
    {
            parent::__construct();
    }

        /**
         * @return array
         */
    public function getAll(): array
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->toSQL();
            return $this->query($sql)
                ->fetchAll($this->mode);
    }

        /**
         * @param int $id
         * @return array
         */
    public function getOne(int $id): stdClass
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->where($this->table[0] . '.id = ' . $id)
                ->toSQL();
            return $this->query($sql)
                ->fetch($this->mode);
    }

        /**
         * @param string $name
         * @return array
         */
    public function getByName(string $name): array
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->where($this->table[0] . '.name = ' . $name)
                ->toSQL();
            return $this->query($sql)
                ->fetch($this->mode);
    }

        /**
         * @param array $data
         * @return string|false return last id
         */
    public function create(array $data): string|false
    {
           return $this->insert($this->table, $data);
    }

        /**
         * @param int|string $id
         * @param array $data
         * @return bool
         */
    public function updateGenre(int|string $id, array $data): bool
    {
            return $this->update($this->table, $data, $id)->execute();
    }

        /**
         * @param int|string $id
         * @return bool
         */
    public function deleteGenre(int|string $id): bool
    {
            return $this->delete($this->table, $id)->execute();
    }

        /**
         * @param int $id
         * @return array|false
         */
    public function getMovies(int $id): array|false
    {
        if (!$this->exist($id)) {
                return false;
        }

            $sql = $this->queryBuilder
                ->from('movie_genre', 'mg')
                ->where('mg.id_genre = ' . $id)
                ->toSQL();

            $pivotData = $this->query($sql)
                ->fetchAll($this->mode);

            $movies = [];

        foreach ($pivotData as $data) {
                $sql = $this->queryBuilder
                    ->from('movie', 'm')
                    ->where('m.id = ' . $data->id_movie)
                    ->toSQL();
                $movies[] = $this->query($sql)
                    ->fetch($this->mode);
        }

            return $movies;
    }

        /**
         * @param $id
         * @return bool
         */
    public function exist($id): bool
    {
            // check if genre exists
        if ($this->getOne($id)) {
                return true;
        }

            return false;
    }
}
