<?php

namespace Core;

class Router
{
    private static array $routes = [];

        /**
         * @param  string $url
         * @param  array  $route
         * @return void
         */
    public static function connect(string $url, array $route): void
    {
            // check if the url is already set
        if (array_key_exists($url, self::$routes)) {
                echo '404 error: This route already exists' . PHP_EOL . '<br>';
        }

            // check if a method is set
        if (!isset($route['action'])) {
                echo '404 error: No method has been set for this route' . PHP_EOL . '<br>';
                self::exec(
                    'Controller\\ErrorController',
                    'giveError',
                    [500, "Developper Error", "[{$route['action']}] not found"]
                );
                die();
        }

            // check if a controller is set
        if (!isset($route['controller'])) {
                echo '404 error: No controller has been set for this route' . PHP_EOL . '<br>';
                self::exec(
                    'Controller\\ErrorController',
                    'giveError',
                    [500, "Developper Error", "[{$route['controller']}] not found"]
                );
                die();
        }

            //set the real controller
            $route['controller'] = ucfirst($route['controller']) . 'Controller';
            // set the controller
            $route['controller'] = "\\Controller\\" . $route['controller'];
            // check if the controller exists
        if (!class_exists($route['controller'])) {
                echo '404 error: This controller does not exist' . PHP_EOL . '<br>';
                self::exec(
                    'Controller\\ErrorController',
                    'giveError',
                    [500, "Server Error", "Class [{$route['controller']}] not found"]
                );
                die();
        }

            // check if the method exists
        if (!method_exists($route['controller'], $route['action'])) {
               echo '404 error: This method does not exist' . PHP_EOL . '<br>';
               self::exec(
                   'Controller\\ErrorController',
                   'giveError',
                   [
                       500,
                       "Server Error",
                       "Method [{$route['action']}] not found in [{$route['controller']}] with url: [{$url}]"
                   ]
               );
               die();
        }

            // set route
            self::$routes[$url] = $route;
            self::$routes[$url]['controller'] = $route['controller'];
            self::$routes[$url]['action'] = $route['action'];
            self::$routes[$url]['method'] = $route['method'] ?? $_SERVER['REQUEST_METHOD'];
            self::$routes[$url]['params'] = $route['params'] ?? [];
            self::$routes[$url]['params'] = $route['params'] ?? [];
            self::$routes[$url]['previous_path'] = "";
            $real_name_of_controller = str_replace(
                '\\Controller\\',
                '',
                "{$route['controller']}@{$route['action']}"
            );
            self::$routes[$url]['name'] = $real_name_of_controller;
    }

        /**
         * @param  string $url
         * @throws \Exception
         * @return array|false
         */
    public static function get(string $url): array|false
    {
            // normal route
            $route = self::$routes[$url] ?? null;
        if ($route) {
                // route without parameters {id}
                return $route;
        } else {
                // check route with parameters {any}
            foreach (self::$routes as $key => $value) {
                    $pattern = preg_replace('/{([a-z]+)}/', '([a-z0-9-]+)', $key);
                    $pattern = str_replace('/', '\/', $pattern);
                    $pattern = '/^' . $pattern . '$/';
                if (preg_match($pattern, $url, $matches)) {
                        $route = $value;
                        $route['params'] = [];
                    foreach ($matches as $k => $match) {
                        if (is_string($key)) {
                                //give name of the parameter by checking the url
                                $params = self::getStringsWithCurlyBraces($key);
                                $route['params'][$params] = $match;
                        }
                    }

                    if (isset($_SERVER['QUERY_STRING'])) {
                                 // add current optional parameter to the route
                                 $params = [];
                                 parse_str($_SERVER['QUERY_STRING'], $params);
                                  $route['params'] = array_merge($route['params'], $params);
                                  unset($route['params'][0]);
                    }

                            return $route;
                }
            }
        }

            return false;
    }

    private static function getStringsWithCurlyBraces(string $text): string
    {
            $matches = [];
            preg_match('/{([a-z]+)}/', $text, $matches);
            return $matches[1];
    }


        /**
         * @param string $controller
         * @param string $method
         * @param array $params
         * @return mixed
         */
    public static function exec(string $controller, string $method, array $params): mixed
    {
            // call the controller and method with parameters (spread operator)
            return (new $controller())->$method(...$params);
    }
}
