<?php

require_once './vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$GLOBALS['app'] = $app;

require './app/routes.php';

$app->run();
?>