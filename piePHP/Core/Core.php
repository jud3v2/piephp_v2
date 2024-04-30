<?php

namespace Core;

class Core
{
        /**
         * @throws \Exception
         * @return void
         */
    public function run($overWriteUrl = null, mixed $data = []): void
    {
        try {
                include_once "src/Routes/index.php";
                $url = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'];
                $app = Router::get($overWriteUrl ?? $url);
            if ($app !== false) {
                $controller = $app['controller'];
                $action = $app['action'];
                Router::exec($controller, $action, array_merge($app['params'], $data));
                die();
            } else {
                    $controller = 'Controller\\ErrorController';
                    $action = 'giveError';
                    Router::exec($controller, $action, [404, 'Not Found',
                        'The page you are looking for does not exist']);
                    die();
            }
        } catch (\Exception $e) {
                $controller = 'Controller\\ErrorController';
                $action = 'giveError';
                Router::exec($controller, $action, [500, "Server Error", 'An error occurred on the server']);
                die();
        }
    }
}
