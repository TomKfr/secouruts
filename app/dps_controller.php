<?php

use Silex\Application;
use Silex\ControllerProviderInterface;
use Secouruts\DPS;

class DPSController implements ControllerProviderInterface
{
	public function connect(Application $app)
	{
		$controllers = $app['controllers_factory'];

		$controllers->post('/new_post',function() use ($app){
			$id = $_POST['id'];
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

			if($id == null){
				$newdps = new DPS();
			}
			else{
				$newdps = $app['entity_manager']->find('Secouruts\DPS', $id);
			}

			$newdps->setTitre($titre);
			$newdps->setType($type);
			$newdps->setDesc($desc);
			$newdps->setLieu($lieu);
			$newdps->setLimitDate(\DateTime::createFromFormat('d/m/Y', $limdate));
			$newdps->setPSE1($nbpse1);
			$newdps->setPSE2($nbpse2);
			$newdps->setDebut(\DateTime::createFromFormat('d/m/Y H:i', $debut));
			$newdps->setFin(\DateTime::createFromFormat('d/m/Y H:i', $fin));
			$newdps->setClient($client);

			$app['entity_manager']->persist($newdps);

			$newdps->genererCreneaux(); //On génère les créneaux associés à ce poste.

			$app['entity_manager']->flush(); //On flush le poste, les créneaux sont sauvegardés en cascade

			return $newdps->getId();
		});

		$controllers->get('/get/{id}', function($id) use ($app)
		{
			if($id == "all"){
				$postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
				return $postes;
			}
			else {
				$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);

				$i = 0;
				$crenos = array();

				foreach ($dps->getCreneaux() as $creneau) { // COPIE des créneaux et des participants dans un tableaus pour passage à la page
					$item = array();
					$item['time'] = $creneau->getDateDeb()->format('H:i')." - ".$creneau->getDateFin()->format('H:i');
					foreach ($creneau->getSecouristes() as $user) {
						$item[$user->getLogin()] = $user->getPrenom()." ".$user->getNom();
					}
					$crenos[$creneau->getId()] = $item;
				}

				// return print_r($crenos);

				ob_start();
				require './views/dps_info.php';
				$view = ob_get_clean();
				return $view;
			}
		});

		$controllers->get('/delete/{id}', function($id) use ($app){
			if($id != null){
				$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);
				$app['entity_manager']->remove($dps);
				$app['entity_manager']->flush();
				return $id;
			}
			else return "err";
		});

		$controllers->get('/close/{id}', function($id) use ($app){
			if($id != null){
				$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);

				if($dps->isClosed()){
					$dps->setClosed(false);
					$app['entity_manager']->flush();
					return "Le poste ".$dps->getTitre()." est ouvert";
				}
				else{
					$dps->setClosed(true);
					$app['entity_manager']->flush();
					return "Le poste ".$dps->getTitre()." est clos";
				}
			}
			else return "err";
		});

		$controllers->get('/cancel/{id}', function($id) use ($app){
			if($id != null){
				$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);
				$dps->setCancelled(true);
				$app['entity_manager']->flush();
				return "ok";	
			}
			else return "err";
		});

	return $controllers;
	}
}

?>