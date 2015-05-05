<?php

// require_once __DIR__.'/../model/DPS.php';
// require_once __DIR__.'/../model/Creneau.php';
// require_once __DIR__.'/../model/Inscription.php';
// require_once __DIR__.'/../model/Secouriste.php';

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class DPSController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

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
			$newdps->setLimitDate(new \DateTime(trim($limdate)));
			$newdps->setPSE1($nbpse1);
			$newdps->setPSE2($nbpse2);
			$newdps->setDebut(new \DateTime(trim($debut)));
			$newdps->setFin(new \DateTime(trim($fin)));
			$newdps->setClient($client);

			$app['entity_manager']->persist($newdps);
			$app['entity_manager']->flush();

			return "OK";
		});

		$controllers->get('/get/{id}', function($id) use ($app)
		{
			if($id == "all"){
				$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
				return $postes;
			}
			else {

			}
		});


		return $controllers;
	}
}

?>