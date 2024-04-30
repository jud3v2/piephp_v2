<?php

namespace Controller;

use Core\Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\GenreModel;
use Model\MovieGenreModel;

class GenreController extends Controller
{
        /**
         * @var \Model\GenreModel
         */
    private GenreModel $genreModel;

    public function __construct()
    {
            parent::__construct();
            $this->genreModel = new GenreModel();
    }

        /**
         * @param string|null $message
         * @param string|null $success
         * @param string|null $error
         * @return void
         */
        #[NoReturn] public function index(
            string $message = null,
            string $success = null,
            string $error = null
        ): void {
                $genres = $this->genreModel->getAll();

            foreach ($genres as $genre) {
                    $genre->movies = $this->genreModel->getMovies($genre->id);
            }

                $this->render('genre.index', [
                    'genres' => $genres,
                    'message' => $message,
                    'success' => $success,
                    'error' => $error
                ]);
        }


        /**
         * @return void
         */
        #[NoReturn] public function create(): void
        {
                $this->render('genre.create');
        }

        /**
         * @return void
         */
        #[NoReturn] public function store(): void
        {
                $data = [
                    'name' => $_POST['name'],
                ];

                if ($this->genreModel->create($data)) {
                        $this->redirect('/genre', ['success' => 'Le genre a bien été créé.']);
                } else {
                        $this->redirect('/genre', ['error' => 'Le genre n\'a pas été créé.']);
                }
        }

        /**
         * @param int $id
         * @return void
         */
        #[NoReturn] public function edit(int $id): void
        {
                $genre = $this->genreModel->getOne($id);
                $genre->movies = $this->genreModel->getMovies($genre->id);
                $this->render('genre.edit', ['genre' => $genre]);
        }

        /**
         * @param int $id
         * @return void
         */
        #[NoReturn] public function update(int $id): void
        {
                $data = [
                    'name' => $_POST['name'],
                ];

                if ($this->genreModel->update('genre', $data, 'id = ' . $id)) {
                        $this->redirect('/genre', ['success' => 'Le genre a bien été modifié.']);
                } else {
                        $this->redirect('/genre', ['error' => 'Le genre n\'a pas été modifié.']);
                }

                die();
        }

        /**
         * @param int $id
         * @return void
         */
        #[NoReturn] public function destroy(int $id): void
        {
                // check if the genre have movie_genre
                $moviesRelatedToGenre = $this->genreModel->getMovies($id);
                $movieGenreModel = new MovieGenreModel();

            foreach ($moviesRelatedToGenre as $movie) {
                    $movieGenreModel->deleteMovieGenre($movie->id);
            }

            if ($this->genreModel->delete('genre', 'id = ' . $id)) {
                    $this->redirect('/genre', ['success' => 'Le genre a bien été supprimé.']);
            } else {
                    $this->redirect('/genre', ['error' => 'Le genre n\'a pas été supprimé.']);
            }

                die();
        }
}
