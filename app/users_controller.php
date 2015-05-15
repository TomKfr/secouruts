<?php

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\Secouriste;
use Secouruts\Diplome;

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
			$newuser->setLDN("");
			$newuser->setAdresse("");
			$newuser->setEmail("");
			$newuser->settel("");
			$newuser->setTaille("");
			$newuser->setSemestre("");
			$newuser->setPermis(false);

			$app['entity_manager']->persist($newuser);
			$app['entity_manager']->flush();

			return $newuser->getLogin();

		});

		$controllers->match('/modify_user/{login}',function($login) use ($app){
			//$login = $_POST['login'];
			$nom = $_POST['nom'] ; 
			$prenom = $_POST['prenom'];
			if(isset($_POST['admin'])) $admin = true; 
			else $admin = false;

			$modifuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);

			$modifuser->setNom($nom);
			$modifuser->setPrenom($prenom);
			$modifuser->setAdmin($admin);
			if(isset($_POST['pse1'])) {
				$dip = new Diplome();
				$dip->setType('PSE1');
				$dip->setDate($_POST['date_pse1']);
				$modifuser->addDiplome($dip);
			}
			if(isset($_POST['pse2'])) {
				$dip = new Diplome();
				$dip->setType('PSE2');
				$dip->setDate($_POST['date_pse2']);
				$modifuser->addDiplome($dip);
			}
			if(isset($_POST['lat'])) {
				$dip = new Diplome();
				$dip->setType('LAT');
				$dip->setDate($_POST['date_lat']);
				$modifuser->addDiplome($dip);
			}
			if(isset($_POST['cod1'])) {
				$dip = new Diplome();
				$dip->setType('COD1');
				$dip->setDate($_POST['date_cod1']);
				$modifuser->addDiplome($dip);
			}
			if(isset($_POST['cod2'])) {
				$dip = new Diplome();
				$dip->setType('COD2');
				$dip->setDate($_POST['date_cod2']);
				$modifuser->addDiplome($dip);
			}
			if(isset($_POST['vpsp'])) {
				$dip = new Diplome();
				$dip->setType('VPSP');
				$dip->setDate($_POST['date_vpsp']);
				$modifuser->addDiplome($dip);
			}

			$modifuser->setDDN(new DateTime($_POST['ddn'])); 
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
		$controllers->post('/profil_user',function() use ($app){
			
			$nom = $_POST['nom'] ; 
			$prenom = $_POST['prenom'];
			if(isset($_POST['admin'])) $admin = true; 
			else $admin = false;

			$profiluser = $app['entity_manager']->find('Secouruts\Secouriste', $user);

			$profiluser->setLogin($login);
			$profiluser->setNom($nom);
			$profiluser->setPrenom($prenom);
			$profiluser->setAdmin($admin);
			if(isset($_POST['pse1'])) {
				$dip = new Diplome();
				$dip->setType('PSE1');
				$dip->setDate($_POST['date_pse1']);
				$profiluser->addDiplome($dip);
			}
			if(isset($_POST['pse2'])) {
				$dip = new Diplome();
				$dip->setType('PSE2');
				$dip->setDate($_POST['date_pse2']);
				$profiluser->addDiplome($dip);
			}
			if(isset($_POST['lat'])) {
				$dip = new Diplome();
				$dip->setType('LAT');
				$dip->setDate($_POST['date_lat']);
				$profiluser->addDiplome($dip);
			}
			if(isset($_POST['cod1'])) {
				$dip = new Diplome();
				$dip->setType('COD1');
				$dip->setDate($_POST['date_cod1']);
				$profiluser->addDiplome($dip);
			}
			if(isset($_POST['cod2'])) {
				$dip = new Diplome();
				$dip->setType('COD2');
				$dip->setDate($_POST['date_cod2']);
				$profiluser->addDiplome($dip);
			}
			if(isset($_POST['vpsp'])) {
				$dip = new Diplome();
				$dip->setType('VPSP');
				$dip->setDate($_POST['date_vpsp']);
				$profiluser->addDiplome($dip);
			}

			$profiluser->setDDN($_POST['ddn']); 
			$profiluser->setLDN($_POST['ldn']);
			$profiluser->setAdresse($_POST['adresse']);
			$profiluser->setEmail($_POST['email']);
			$profiluser->settel($_POST['tel']);
			$profiluser->setTaille($_POST['taille']);
			$profiluser->setSemestre($_POST['semestre']);
			$profiluser->setPermis($_POST['permis']);

			$app['entity_manager']->persist($profiluser);
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