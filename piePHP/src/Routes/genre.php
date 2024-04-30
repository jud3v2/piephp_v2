<?php

use Core\Router;

Router::connect('/genre', ['controller' => 'genre', 'action' => 'index']);
Router::connect('/genre/{id}', ['controller' => 'genre', 'action' => 'edit']);
Router::connect('/genre/create', ['controller' => 'genre', 'action' => 'create']);
Router::connect('/genre/store', ['controller' => 'genre', 'action' => 'store']);
Router::connect('/genre/update/{id}', ['controller' => 'genre', 'action' => 'update']);
Router::connect('/genre/delete/{id}', ['controller' => 'genre', 'action' => 'destroy']);
