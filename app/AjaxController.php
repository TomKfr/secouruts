<?php

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;
use Secouruts\Secouriste;

class AjaxController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->get('/users_content', function(){
			ob_start();
			require './views/users_content.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/users_form', function(){
			ob_start();
			require './views/form_add_user.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/postes_content', function() use ($app) {
			
			$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();

			ob_start();
			require './views/postes_content.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/dps_form', function(){
			ob_start();
			require './views/form_add_dps.php';
			$view = ob_get_clean();
			return $view;
		});

		


		return $controllers;
	}
}

?>