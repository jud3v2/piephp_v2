<?php
// @workspace
// Procédural
define('BASE_DIRECTORY', str_replace('\\', "/", substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require $_SERVER['DOCUMENT_ROOT'] . '/Core/autoload.php';
spl_autoload_register('autoload_classes');
require_once(implode(DIRECTORY_SEPARATOR, [$_SERVER['DOCUMENT_ROOT'],'Core', 'autoload.php']));
$app = new Core\Core();
try {
        $app->run();
} catch (Exception $e) {
        echo $e->getMessage();
}
