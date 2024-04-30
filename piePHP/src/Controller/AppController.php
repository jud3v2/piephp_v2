<?php

namespace Controller;

use Core\Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\DistributorModel;
use Model\GenreModel;
use Model\MovieGenreModel;
use Model\MovieModel;

class AppController extends Controller
{
    public function __construct()
    {
            parent::__construct();
    }

        /**
         * @param mixed|null $message
         * @return void
         */
        #[NoReturn] public function index(mixed $message = null): void
        {
                $movies = new MovieModel();
                $this->render('app.index', [
                    'movies' => $movies->getRandomMovies(),
                    'message' => $message
                ]);
        }

        /**
         * @param $id
         * @return void
         */
        #[NoReturn] public function showMovie($id): void
        {
                $movie = new MovieModel();
            if ($movie->findMovie($id)) {
                    $this->render('app.show', ['d' => $movie->getOneMovies($id)]);
            } else {
                    $this->redirect('/', ['message' => 'Film introuvable !']);
            }
        }

        /**
         * @param $id
         * @return void
         */
        #[NoReturn] public function updateMovie($id): void
        {
                $movie = new MovieModel();
                $genres = (new GenreModel())->getAll();
                $m = $movie->getOneMovies($id);
                $data = [
                    ...$m,
                    'genre' => $movie->hasOne(MovieGenreModel::class, $id, 'id_movie'),
                    'distributor' => (new DistributorModel())->getOneDistributor($m['distributor']['id'])
                ];

                $this->render('app.update', [
                    'd' => $data,
                    'genres' => $genres
                ]);
        }

        /**
         * @param $id
         * @return void
         */
        #[NoReturn] public function updateMovieWithDistributor($id): void
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $data = $_POST;
                    $movie = new MovieModel();
                    $movie->updateMovie($id, $data);
                    $this->redirect('/', ['message' => 'Film modifié avec succès !']);
            } else {
                    $this->headerRedirect('/');
            }
        }

        /**
         * @return void
         */
        #[NoReturn] public function createMovie(): void
        {
                $genres = (new GenreModel())->getAll();
                $this->render('app.create', ['genres' => $genres]);
                die();
        }

        /**
         * @return void
         */
        #[NoReturn] public function createMovieWithDistributor(): void
        {
                $data = $_POST;
                //var_dump($data, count($data));

            if (!empty($_POST)) {
                    $movie = new MovieModel();
                    $movie->createMovie($data);
                    $this->redirect('/', ['message' => 'Film ajouté avec succès !']);
            } else {
                    $genres = (new GenreModel())->getAll();
                    $this->render('app.create', ['genres' => $genres]);
            }

                die();
        }

        /**
         * @param $id
         * @return void
         */
        #[NoReturn] public function deleteMovie($id): void
        {
                $movie = new MovieModel();
                // delete genre movie
                (new MovieGenreModel())->deleteMovieGenre($id);
            if ($movie->deleteMovie($id)) {
                    $this->redirect('/', ['message' => 'Film supprimé avec succès !']);
            } else {
                    $this->redirect('/', ['message' => 'Erreur lors de la suppression du film !']);
            }
        }
}
