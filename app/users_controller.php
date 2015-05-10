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
			$nom = $_POST['nom'] ; 
			$prenom = $_POST['prenom'];
			if(isset($_POST['admin'])) $admin = true; 
			else $admin = false;

			$newuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);

			if($newuser == null) $newuser = new Secouriste();

			$newuser->setLogin($login);
			$newuser->setNom($nom);
			$newuser->setPrenom($prenom);
			$newuser->setAdmin($admin);

			$newuser->setDDN(new \DateTime()); 
			$newuser->setLDN("0");
			$newuser->setAdresse("0");
			$newuser->setEmail("0");
			$newuser->settel("0");
			$newuser->setTaille("0");
			$newuser->setSemestre("0");
			$newuser->setPermis(false);

			$app['entity_manager']->persist($newuser);
			$app['entity_manager']->flush();

			return $newuser->getLogin();

		});

		$controllers->post('/modify_user',function() use ($app){
			$login = $_POST['login'];
			$nom = $_POST['nom'] ; 
			$prenom = $_POST['prenom'];
			if(isset($_POST['admin'])) $admin = true; 
			else $admin = false;

			$modifuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);

			$modifuser->setLogin($login);
			$modifuser->setNom($nom);
			$modifuser->setPrenom($prenom);
			$modifuser->setAdmin($admin);

			$modifuserr->setDDN($_POST['ddn']); 
			$modifuser->setLDN($_POST['ldn']);
			$modifuser->setAdresse($_POST['adresse']);
			$modifuser->setEmail($_POST['email']);
			$modifuser->settel($_POST['tel']);
			$modifuser->setTaille($_POST['taille']);
			$modifuser->setSemestre($_POST['semestre']);
			$modifuser->setPermis($_POST['permis']);

			$app['entity_manager']->persist($modifuser);
			$app['entity_manager']->flush();

			return $modifuser->getLogin();

		});

		$controllers->get('/get/{login}', function($login) use ($app)
		{
			if($login == "all"){
				$secouriste = $app['entity_manager']->getRepository('Secouruts\Secouriste')->findAll();
				return $secouriste;
			}
			else {
				$secouriste = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
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