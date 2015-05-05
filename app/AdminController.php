<?php

// require __DIR__.'/../model/DPS.php';
// require __DIR__.'/../model/Creneau.php';
// require __DIR__.'/../model/Inscription.php';
// require __DIR__.'/../model/Secouriste.php';

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class AdminController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->get('/', function() {
			$user = $GLOBALS['user'];
			ob_start();
			require './views/admin_view.php';
			$view = ob_get_clean();
			return $view;
		});


		return $controllers;
	}
}

?>