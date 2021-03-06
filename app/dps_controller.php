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
				// $postes = $app['entity_manager']->getRepository('Secouruts\DPS')->findAll();
				$qb = $app['entity_manager']->createQueryBuilder();
				$qb->select('dps')
		   			->from('Secouruts\DPS', 'dps')
		   			->orderBy('dps.debut', 'ASC');
				$postes = $qb->getQuery()->getResult();
				return $postes;
			}
			else {
				$dps = $app['entity_manager']->getRepository('Secouruts\DPS')->find($id);

				$i = 0;
				$crenos = array();

				foreach ($dps->getCreneaux() as $creneau) { // COPIE des créneaux et des participants dans un tableaux pour passage à la page
					$item = array();
					$item['time'] = $creneau->getDateDeb()->format('H:i')." - ".$creneau->getDateFin()->format('H:i');
					foreach ($creneau->getSecouristes() as $user) {
						$item[$user->getLogin()] = $user->getPrenom()." ".$user->getNom()." <small>(".$user->getBestDiplome().")</small>";
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

					$message = \Swift_Message::newInstance()
			        ->setSubject('[Secouruts] Le poste :'.$dps->getTitre()." à été cloturé.")
			        ->setFrom('secouruts@assos.utc.fr')
			        ->setTo($dps->getParticipantsMails())
			        ->setBody("Les inscriptions pour le poste ".$dps->getTitre()." ont été fermées.\n
			        	Tu es maintenant engagé à tenir le poste aux créneaux pour lesquels ton inscription a été validée.\n
			        	On compte sur toi !");

			        $app['mailer']->send($message);

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
				$message = \Swift_Message::newInstance()
			        ->setSubject('[Secouruts] Le poste :'.$dps->getTitre()." à été annulé.")
			        ->setFrom('secouruts@assos.utc.fr')
			        ->setTo($dps->getParticipantsMails())
			        ->setBody("Le poste ".$dps->getTitre()." a été annulé.\n
			        	Tu n'es donc plus engagé sur cet événement.\n");

			        $app['mailer']->send($message);
				return "ok";	
			}
			else return "err";
		});

	return $controllers;
	}
}

?>