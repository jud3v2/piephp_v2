<?php

namespace Core;

class DynamicRouter
{
        /**
         * @return string
         */
    public static function getController(): string
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        return $url[0];
    }

        /**
         * @return string
         */
    public static function getAction(): string
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        return $url[1];
    }

        /**
         * @throws \Exception
         * @return void
         */
    public static function connect(): void
    {
            // check if the url is already set of no controller and action is set by default
        if (!self::getController() && !self::getAction()) {
                Router::connect(
                    '/',
                    [
                    'controller' => 'app',
                    'action' => 'index'
                        ]
                );
        } else {
                Router::connect(
                    url: $_SERVER['REQUEST_URI'],
                    route: [
                        'controller' => self::getController(),
                        'action' => self::getAction()
                    ]
                );
        }
    }
}
