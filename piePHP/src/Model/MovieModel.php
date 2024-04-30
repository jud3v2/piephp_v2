<?php

namespace Model;

use Core\Entity;
use PDO;

class MovieModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'movie';

    public function __construct()
    {
            parent::__construct();
    }

        /**
         * return all movies
         * @return array|false
         */
    public function getMovies(): array|false
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->toSQL();

            return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findMovie($id): false|array
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->where("id = $id")
                ->toSQL();

            return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

        /**
         * get one movie
         * @param $id
         * @return array
         */
    public function getOneMovies($id): array
    {
            $sql = $this->queryBuilder
                ->from($this->table, $this->table[0])
                ->where("id = $id")
                ->toSQL();

            $film = $this->query($sql)->fetch(PDO::FETCH_ASSOC);

            $sql = $this->queryBuilder
                ->from('movie_genre', 'mg')
                ->where("id_movie = $id")
                ->toSQL();

            $genre = $this->query($sql)->fetch(PDO::FETCH_ASSOC);

            $sql = $this->queryBuilder
                ->from('genre', 'g')
                ->where("id = {$genre['id_genre']}")
                ->toSQL();

            $genre = $this->query($sql)->fetch(PDO::FETCH_ASSOC);

            $sql = $this->queryBuilder
                ->from('distributor', 'd')
                ->where("id = {$film['id_distributor']}")
                ->toSQL();

            $distributor = $this->query($sql)->fetch(PDO::FETCH_ASSOC);

            $sql = $this->queryBuilder
                ->from('movie_schedule', 'ms')
                ->where("id_movie = $id")
                ->toSQL();

            $movieSchedule = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // fetch each room for each movie at once request

        foreach ($movieSchedule as $key => $schedule) {
                $sql = $this->queryBuilder
                    ->from('room', 'r')
                    ->where("id = {$schedule['id_room']}")
                    ->toSQL();

                $movieSchedule[$key]['room'] = $this->query($sql)
                    ->fetch(PDO::FETCH_ASSOC);
        }

            $data = [
                'film' => $film,
                'genre' => $genre,
                'distributor' => $distributor,
                'movieSchedule' => $movieSchedule
            ];

            return $data;
    }

        /**
         * @return array
         */
    public function getRandomMovies(): array
    {
            $movies = $this->getMovies();
            $randomMovies = [];
        for ($i = 0; $i < 10; $i++) {
                $randomMovies[] = $movies[array_rand($movies)];
        }

            return $randomMovies;
    }

        /**
         * @param array $data
         * @return bool
         */
    public function createMovie(array $data): bool
    {
        try {
                // extract each data for each table

                $distributor = [
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'zipcode' => $data['zipcode'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'phone' => $data['phone']
                ];

                $idOfDistributor = (new DistributorModel())->createDistributor($distributor);

                $movie = [
                    'title' => $data['title'],
                    'duration' => $data['duration'],
                    'director' => $data['director'],
                    'rating' => $data['rating'],
                    'release_date' => $data['release_date'],
                    'id_distributor' => $idOfDistributor
                ];

                $idOfMovie = $this->createMoviesData($movie);

                $movie_genre = [
                    'id_genre' => $data['genre'],
                    'id_movie' => $idOfMovie
                ];

                $movieGenre = (new MovieGenreModel())->createMovieGenre($movie_genre);

                if ($movieGenre) {
                        return true;
                }

                return false;
        } catch (\Exception $e) {
                return false;
        }
    }

        /**
         * @param array $data
         * @return false|string
         */
    private function createMoviesData(array $data): false|string
    {
            return $this->insert($this->table, $data);
    }

        /**
         * @param $id
         * @param $data
         * @return bool|string
         */
    public function updateMovie($id, $data): bool|string
    {
            $film = [
                'title' => $data['title'],
                'director' => $data['director'],
                'duration' => $data['duration'],
                'rating' => $data['rating'],
                'release_date' => $data['release_date'],
                'id_distributor' => $data['id_distributor']
            ];

            $genre = [
                'id_genre' => $data['genre'],
                'id_movie' => $id
            ];

            $distributor = [
                'name' => $data['name'],
                'address' => $data['address'],
                'zipcode' => $data['zipcode'],
                'city' => $data['city'],
                'country' => $data['country'],
                'phone' => $data['phone']
            ];

            try {
                    (new DistributorModel())->updateDistributor($data['id_distributor'], $distributor);
                    (new MovieGenreModel())->updateMovieGenre($id, $genre);
                if ($this->update($this->table, $film, "id = $id")->execute()) {
                        return true;
                }

                    return false;
            } catch (\Exception $e) {
                    return $e->getMessage();
            }
    }

        /**
         * @param string|int $id
         * @return bool
         */
    public function deleteMovie(string|int $id): bool
    {
            return $this->delete($this->table, "id = $id")->execute();
    }
}
