<?php

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\Secouriste;

class UsersController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->post('/new_user',function() use ($app){
			$login = $_POST['login'];
			$nom = $_POST['name'] ;
			$prenom = $_POST['firstname'] ;
			$admin = $_POST['admin'] ;

			if($login == null){
				$newuser = new Secouriste();
			}
			else{
				$newuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);
			}

			$newuser->setLogin($login);
			$newuser->setNom($nom);
			$newuser->setPrenom($prenom);
			$newuser->setAdmin($admin);

			$app['entity_manager']->persist($newuser);
			$app['entity_manager']->flush();

			return $newuser->getLogin();
		});

		$controllers->get('/get/{login}', function($login) use ($app)
		{
			if($login == "all"){
				$users = $app['entity_manager']->getRepository('Secouruts\Secouriste')->findAll();
				return $users;
			}
			else {
				$user = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
				ob_start();
				require './views/user_info.php';
				$view = ob_get_clean();
				return $view;
			}
		});

		$controllers->get('/delete/{login}', function($login) use ($app){
			if($login != null){
				$user = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
				$app['entity_manager']->remove($user);
				$app['entity_manager']->flush();
				return "ok";
			}
			else return "err";
		});

	return $controllers;
	}
}

?>