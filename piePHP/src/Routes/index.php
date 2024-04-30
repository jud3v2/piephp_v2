<?php

// include all routes files
require 'movies.php';
require 'genre.php';
require 'user.php';

use Core\Router;

Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Router::connect('/error', ['controller' => 'error', 'action' => 'giveError']);
Router::connect('/test/hugo', ['controller' => 'test', 'action' => 'index']);
