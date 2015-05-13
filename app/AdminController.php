<?php

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class AdminController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->get('/', function() {
			$user2 = $_SESSION['user2'];
			$target = 'dps';
			ob_start();
			require './views/admin_view.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/dps', function() {
			$user2 = $_SESSION['user2'];
			$target = 'dps';
			ob_start();
			require './views/admin_view.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/users', function() {
			$user2 = $_SESSION['user2'];
			$target = 'users';
			ob_start();
			require './views/admin_view.php';
			$view = ob_get_clean();
			return $view;
		});


		return $controllers;
	}
}

?>