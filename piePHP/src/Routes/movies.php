<?php

use Core\Router;

Router::connect('/movie/{id}', ['controller' => 'app', 'action' => 'showMovie']);
Router::connect('/movie/update/{id}', ['controller' => 'app', 'action' => 'updateMovie']);
Router::connect('/movie/update/{id}/send', ['controller' => 'app', 'action' => 'updateMovieWithDistributor']);
Router::connect('/movie/create', ['controller' => 'app', 'action' => 'createMovie']);
Router::connect('/movie/delete/{id}', ['controller' => 'app', 'action' => 'deleteMovie']);
Router::connect('/movie/create-with-distributor', ['controller' => 'app', 'action' => 'createMovieWithDistributor']);
