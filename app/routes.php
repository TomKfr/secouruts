<?php

require_once 'require.php';

function init(){ // Appelée à chaque connexion, vérifie si la date de chaque poste est passée ou non 
	$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
	foreach ($postes as $dps) {
		$dps->closedIfPassed();
	}
}

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

// Home page
$app->get('/', function () use ($app) {
	$user = $GLOBALS['user'];
	$user2 = $_SESSION['user2'];

	// $postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
	// foreach ($postes as $dps) {
	// 	$dps->closeIfPassed();
	// }
	$app['entity_manager']->flush();

	if(is_null($user2)){ //Si l'utilisateur n'est pas dans la base, il est interdit d'accès.
		ob_start();
    	require './views/login_unauthorized.html';
    	$view = ob_get_clean();
    	return $view;
	}
	elseif (is_null($user2->getLDN()) || $user2->getLDN() == ""){ // Si le lieu de naissance n'a pas été renseigné c'est que le profil n'a pas été complété -> envoi vers profile
		$display_all = false;
		ob_start();
    	require './views/profile_view.php';
    	$view = ob_get_clean();
    	return $view;
	}
	else {		// Sinon, l'utilisateur est autorisé et le profil est complet -> envoi sur la page principale
		$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
    	ob_start();
    	require './views/event_view.php';
    	$view = ob_get_clean();
    	return $view;
	}
});

$app->get('/profile', function(){
	$display_all = true;
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