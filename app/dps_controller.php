<?php

require __DIR__.'/../model/DPS.php';
require __DIR__.'/../model/Creneau.php';
require __DIR__.'/../model/Inscription.php';
require __DIR__.'/../model/Secouriste.php';

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class DPSController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->get('/', function() {
			$user = $GLOBALS['user'];
			ob_start();
			require './views/admin_view.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/users_content', function(){
			ob_start();
			require './views/users_content.html';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->get('/postes_content', function(){
			ob_start();
			require './views/postes_content.php';
			$view = ob_get_clean();
			return $view;
		});

		$controllers->post('/new_post',function() use ($app){
			$titre = $_POST['titre'] ;
			$type = $_POST['typpost'] ;
			$desc = $_POST['desc'] ;
			$lieu = $_POST['lieu'] ;
			$limdate = $_POST['limitdate'] ;
			$nbpse1 = $_POST['nbpse1'] ;
			$nbpse2 = $_POST['nbpse2'] ;
			$debut = $_POST['datedeb'] ;
			$fin = $_POST['datefin'] ;
			$client = $_POST['client'] ;

			$newdps = new DPS();

			$newdps->setTitre($titre);
			$newdps->setType($type);
			$newdps->setDesc($desc);
			$newdps->setLieu($lieu);
			$newdps->setLimitDate(new \DateTime($limdate));
			$newdps->setPSE1($nbpse1);
			$newdps->setPSE2($nbpse2);
			$newdps->setDebut(new \DateTime($debut));
			$newdps->setFin(new \DateTime($fin));
			$newdps->setClient($client);

			$app['entity_manager']->persist($newdps);
			$app['entity_manager']->flush();

			return "OK";
		});


		return $controllers;
	}
}

?>