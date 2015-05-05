<?php

// require __DIR__.'/../model/DPS.php';
// require __DIR__.'/../model/Creneau.php';
// require __DIR__.'/../model/Inscription.php';
// require __DIR__.'/../model/Secouriste.php';

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class AjaxController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->get('/users_content', function(){
			ob_start();
			require './views/users_content.html';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/postes_content', function(){
			ob_start();
			require './views/postes_content.php';
			$view = ob_get_clean();
			return $view;
		});

		


		return $controllers;
	}
}

?>