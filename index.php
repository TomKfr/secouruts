<?php

require_once './vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// obtaining the entity manager
$app['entity_manager'] = require './src/doctrine/doctrine.php';

require './app/routes.php';

$app->run();
?>