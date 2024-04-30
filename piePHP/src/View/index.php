<?php

use Core\Bonus\SecurityFacade;
use Core\Bonus\Session;

$app = new SecurityFacade(Session::class);
$app->start();

?>

<!doctype html>
<html lang="fr">
    <?php include "Partials/head/index.php"; ?>
<body>
    <?php include "Partials/header/index.php"; ?>
<main>
        <?php // prevent this error this is why i use the '@' ?>
        <?php //PHP Warning:  Undefined variable $view in .../piePHP/src/View/index.php on line 23 ?>
        <?php /*@var string $view */ echo @$view; ?>
</main>
</body>
    <?php include "Partials/footer/index.php"; ?>
</html>