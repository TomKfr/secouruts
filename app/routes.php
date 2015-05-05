<?php

require_once 'require.php';

// require_once 'auth.php';
// require_once 'dps_controller.php';
// require_once 'AdminController.php';
// require_once 'AjaxController.php';

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

// Home page
$app->get('/', function () use ($app) {
	$user = $GLOBALS['user'];
	$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
    ob_start();             // start buffering HTML output
    require './views/event_view.php';
    $view = ob_get_clean(); // assign HTML output to $view
    return $view;
});

$app->get('/profile', function(){
	$user = $GLOBALS['user'];
	ob_start();
	require './views/profile_view.php';
	$view = ob_get_clean();
	return $view;
});

$app->get('/postes_content/{id}', function($id) use ($app){
	$idposte = $id;
	ob_start();
	require './views/postes_content.php';
	$view = ob_get_clean();
	return $view;
});

$app->get('/logout', function(){
	$GLOBALS['user'] = null;
	require_once './vendor/jasig/phpcas/config.php';
	phpCAS::setDebug();
	phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
	phpCAS::setNoCasServerValidation();
	phpCAS::logout();
});

$app->mount('/dps', new DPSController());
$app->mount('/admin', new AdminController());
$app->mount('/ajax', new AjaxController());

?>