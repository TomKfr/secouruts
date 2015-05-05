<?php

// require_once __DIR__.'/../model/DPS.php';
// require_once __DIR__.'/../model/Creneau.php';
// require_once __DIR__.'/../model/Inscription.php';
// require_once __DIR__.'/../model/Secouriste.php';

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class UsersController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->post('/new_user',function() use ($app){
			$login = $_POST['login'] ;
			$name = $_POST['name'] ;
			$firstname = $_POST['firstname'] ;
			$isAdmin = $_POST['admin'] ;

			$newuser = new DPS();

			$newuser->setLogin($login);
			$newuser->setNom($name);
			$newuser->setPrenom($firstname);
			$newuser->setAdmin($isAdmin);

			$app['entity_manager']->persist($newuser);
			$app['entity_manager']->flush();

			return "OK";
		});

		$controllers->get('/get/{id}', function($id) use ($app)
		{
			if($id == "all"){
				$users = $app['entity_manager']->getRepository('Secouruts\Secouriste')->findAll();
				return $users;
			}
			else {

			}
		});


		return $controllers;
	}
}

?>