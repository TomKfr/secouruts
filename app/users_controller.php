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
			$nom = $_POST['nom'] ; //Le nom de la variable dans le formulaire est 'nom';
			// $prenom = $_POST['firstname'] ; C'est cette ligne qui merdait, je ne comprends pas pourquoi ...
			$prenom = $_POST['prenom'];
			if(isset($_POST['admin'])) $admin = true; //ce test est nécessaire car si la case n'est pas cochée, la variable $_POST['admin'] n'existe pas, ça renvoie une erreur quand tu essayes d'avoir la valeur.
			else $admin = false;

			// if($login == null){                  -------> Login ne sera jamais null car il est rentré dans le formulaire, il faut tester si il est dans la base ou non pour déterminer si c'est une mise à jour.
			// 	$newuser = new Secouriste();
			// }
			// else{
			// 	$newuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);
			// }

			$newuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);

			if($newuser == null) $newuser = new Secouriste();

			$newuser->setLogin($login);
			$newuser->setNom($nom);
			$newuser->setPrenom($prenom);
			$newuser->setAdmin($admin);

			$newuser->setDDN(new \DateTime()); //Des valeurs comme ça, sinon Doctrine refuse d'enregistrer ^^'
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