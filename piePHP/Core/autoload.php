<?php

function autoload_classes(): void
{
        $classes = [
            'core_classes'         => $_SERVER['DOCUMENT_ROOT'] . '/Core/',
            'bonus_classes'       => $_SERVER['DOCUMENT_ROOT'] . '/Core/Bonus/',
            'model_classes'        => $_SERVER['DOCUMENT_ROOT'] . '/src/Model/',
            'view_classes'         => $_SERVER['DOCUMENT_ROOT'] . '/src/View/',
            'controller_classes'   => $_SERVER['DOCUMENT_ROOT'] . '/src/Controller/',
        ];

        foreach ($classes as $name => $path) {
            foreach (glob($path . '*') as $class) {
                if (preg_match('/.php$/', $class)) {
                        include_once $class;
                } elseif (is_dir($class)) {
                        continue;
                } else {
                        include_once $class . '.php';
                }
            }
        }
}
