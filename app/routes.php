<?php

require_once 'require.php';


$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

// Home page
$app->get('/', function () use ($app) {
	$user = $GLOBALS['user'];
	$user2 = $_SESSION['user2'];
	$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
    ob_start();             // start buffering HTML output
    require './views/event_view.php';
    $view = ob_get_clean(); // assign HTML output to $view
    return $view;
});

$app->get('/profile', function(){
	$user2 = $_SESSION['user2'];
	ob_start();
	require './views/profile_view.php';
	$view = ob_get_clean();
	return $view;
});

$app->get('/logout', function(){
	$_SESSION['user2'] = null;
	session_destroy();
	require_once './vendor/jasig/phpcas/config.php';
	phpCAS::logout();
});

$app->mount('/dps', new DPSController());
$app->mount('/admin', new AdminController());
$app->mount('/ajax', new AjaxController());
$app->mount('/secouriste', new UsersController());

?>