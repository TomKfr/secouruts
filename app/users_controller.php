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

		$controllers->match('/modify_user/{login}',function($login) use ($app){ //modification d'un profil utilisateur par l'admin et de l'utilisateur courant
			//$login = $_POST['login'];
			$nom = $_POST['nom'] ; 
			$prenom = $_POST['prenom'];
			// if(isset($_POST['admin'])) $admin = true; 
			// else $admin = false;

			$modifuser = $app['entity_manager']->find('Secouruts\Secouriste', $login);

			$modifuser->setNom($nom);
			$modifuser->setPrenom($prenom);

			if(!isset($_POST['origin'])){ // On vient du formulaire Admin
				if(isset($_POST['admin'])) $modifuser->setAdmin(true); 
				else $modifuser->setAdmin(false);
			}

			if(isset($_POST['pse1']) && $modifuser->getDiplome("PSE1") == null) { // Si le diplome n'existe pas on le crée
				$dip = new Diplome();
				$dip->setType('PSE1');
				$dip->setDate(DateTime::createFromFormat('d/m/Y',$_POST['date_pse1']));
				$modifuser->addDiplome($dip);
			}
			elseif(!isset($_POST['pse1']) && $modifuser->getDiplome("PSE1") != null){ // si il existe on l'enlève
				$modifuser->delDiplome("PSE1");
			}

			if(isset($_POST['pse2'])) {
				$modifuser->delDiplome("PSE2");
				$dip = new Diplome();
				$dip->setType('PSE2');
				$dip->setDate(DateTime::createFromFormat('d/m/Y',$_POST['date_pse2']));
				$modifuser->addDiplome($dip);
			}
			else $modifuser->delDiplome("PSE2");

			if(isset($_POST['lat'])) {
				$modifuser->delDiplome("LAT");
				$dip = new Diplome();
				$dip->setType('LAT');
				$dip->setDate(DateTime::createFromFormat('d/m/Y',$_POST['date_lat']));
				$modifuser->addDiplome($dip);
			}
			else $modifuser->delDiplome("LAT");

			if(isset($_POST['cod1'])) {
				$modifuser->delDiplome("COD1");
				$dip = new Diplome();
				$dip->setType('COD1');
				$dip->setDate(DateTime::createFromFormat('d/m/Y',$_POST['date_cod1']));
				$modifuser->addDiplome($dip);
			}
			else $modifuser->delDiplome("COD1");

			if(isset($_POST['cod2'])) {
				$modifuser->delDiplome("COD2");
				$dip = new Diplome();
				$dip->setType('COD2');
				$dip->setDate(DateTime::createFromFormat('d/m/Y',$_POST['date_cod2']));
				$modifuser->addDiplome($dip);
			}
			else $modifuser->delDiplome("COD2");

			if(isset($_POST['vpsp'])) {
				$modifuser->delDiplome("VPSP");
				$dip = new Diplome();
				$dip->setType('VPSP');
				$dip->setDate(DateTime::createFromFormat('d/m/Y',$_POST['date_vpsp']));
				$modifuser->addDiplome($dip);
			}
			else $modifuser->delDiplome("VPSP");

			$modifuser->setDDN(DateTime::createFromFormat('d/m/Y',$_POST['ddn'])); 
			$modifuser->setLDN($_POST['ldn']);
			$modifuser->setAdresse($_POST['adresse']);
			$modifuser->setEmail($_POST['email']);
			$modifuser->settel($_POST['tel']);
			$modifuser->setTaille($_POST['taille']);
			$modifuser->setSemestre($_POST['semestre']);
			if(isset($_POST['permis'])) $modifuser->setPermis(true);
			else $modifuser->setPermis(false);
			if(isset($_POST['admin'])) $modifuser->setAdmin(true);
			else $modifuser->setAdmin(false);

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