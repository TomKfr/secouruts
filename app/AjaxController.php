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

		$controllers->get('/dps_form/{id}', function($id) use ($app) {

			$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);

			ob_start();
			require './views/form_add_dps.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->match('/sec_cre/{login}/{id}', function($login, $id) use ($app) { 
			// Vérifier l'homogénéité des données entre le créneau, le poste, l'utilisateur et les inscriptions. Corriger les manques.
			$user = $app['entity_manager']->getRepository('Secouruts\Secouriste')->find($login);
			$creneau = $app['entity_manager']->getRepository('Secouruts\Creneau')->find($id);
			$poste = $creneau->getPoste();

			$inscription = $app['entity_manager']->getRepository('Secouruts\Inscription')->findOneBy(array('secouriste' => $user, 'poste' => $poste));

			$returnarray = array();

			if(is_null($inscription)) {							//Si l'inscription n'existe pas, on la crée.	
				$inscription = new Secouruts\Inscription();
				$inscription->setSecouriste($user);
				$inscription->setPoste($poste);
				$app['entity_manager']->persist($inscription);	//Suivie par le manager
			}
																//Si l'inscription existe, on vérifie si le secouriste est déjà dans le créneau en question
			if($creneau->secouristeInscrit($user)){				//Si on trouve l'utilisateur dans le créneau, il s'agit d'une suppression
				$creneau->removeSecouriste($user);				//Exécution de la suppression

				if (!$poste->checkSecIncsr($user)) {			//Vérifie que l'utilisateur n'est plus dans aucun créneau du poste, si oui, supprime l'inscription
					$app['entity_manager']->remove($inscription);
				}
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

		return $controllers;
	}
}

?>