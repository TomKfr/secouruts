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

		$controllers->get('/users_content', function() use ($app) {
			$users = $app['entity_manager']->getRepository('Secouruts\Secouriste')->findAll();
			ob_start();
			require './views/users_content.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/users_form/{login}', function($login) use ($app){
			$user = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
			ob_start();
			require './views/form_add_user.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/users_form2/{login}', function($login) use ($app){
			$user = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
			ob_start();
			require './views/form_modify_user.php';
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

		$controllers->get('/dps_form/{id}', function($id) use ($app) {

			$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);

			ob_start();
			require './views/form_add_dps.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->match('/sec_cre/{login}/{id}', function($login, $id) use ($app) { 
			// Vérifier l'homogénéité des données entre le créneau, le poste, l'utilisateur. Corriger les manques.
			$user = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
			$creneau = $app['entity_manager']->getRepository('Secouruts\Creneau')->find($id);
			$poste = $creneau->getPoste();


			$returnarray = array();

			if($creneau->secouristeInscrit($user)){				//Si on trouve l'utilisateur dans le créneau, il s'agit d'une suppression
				$creneau->removeSecouriste($user);				//Exécution de la suppression
				$creneau->removeSecVal($user->getLogin());
				$returnarray[] = 'remove';
			}
			else {												//Sinon, il s'agit d'un ajout
				$creneau->addSecouriste($user); 				//On exécut l'ajout.
				$returnarray[] = 'add';
			}

			$app['entity_manager']->flush();

			foreach ($creneau->getSecouristes() as $secouriste) {
				$returnarray[] = $secouriste->getPrenom()." ".$secouriste->getNom();
			}

			return json_encode($returnarray);
		});

		$controllers->match('/val_inscr/{login}/{id}', function($login, $id) use ($app) {

			$creneau = $app['entity_manager']->getRepository('Secouruts\Creneau')->find($id);
			$returntxt = "";

			if($creneau->isSecVal($login)) {
				$creneau->removeSecVal($login); //Si le secouriste est déja validé, on l'enlève	
				$returntxt = $login." n'est plus validé sur le créneau ".$creneau->getDateDeb()->format('H:i')." - ".$creneau->getDateFin()->format('H:i');
			} 
			else {
				$creneau->addSecVal($login); //Si le secouriste n'est pas validé, on l'ajoute	
				$returntxt = $login." est validé sur le créneau ".$creneau->getDateDeb()->format('H:i')." - ".$creneau->getDateFin()->format('H:i');	
			}

			$app['entity_manager']->flush();

			return $returntxt;

		});

		return $controllers;
	}
}

?>

