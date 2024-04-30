<?php

use Core\Router;

Router::connect('/register', ['controller' => 'user', 'action' => 'show']);
Router::connect('/store', ['controller' => 'user', 'action' => 'store']);
Router::connect('/login', ['controller' => 'user', 'action' => 'showLogin']);
Router::connect('/profile', ['controller' => 'user', 'action' => 'showProfile']);
Router::connect('/profile/update', ['controller' => 'user', 'action' => 'showUpdateProfile']);
Router::connect('/profile/delete', ['controller' => 'user', 'action' => 'showDelete']);
Router::connect('/user/delete/{id}', ['controller' => 'user', 'action' => 'userDelete']);
Router::connect('/user/update/{id}', ['controller' => 'user', 'action' => 'userUpdate']);
Router::connect('/connect', ['controller' => 'user', 'action' => 'login']);
Router::connect('/logout', ['controller' => 'user', 'action' => 'logout']);
