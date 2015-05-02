<?php

require_once "../src/doctrine/doctrine.php";

require_once "./DPS.php";
require_once "./Secouriste.php";
require_once "./Diplome.php";
require_once "./Inscription.php";
require_once "./Creneau.php";

use Secouruts\DPS;
use Secouruts\Inscription;
use Secouruts\Secouriste;

$poste1 = new DPS();
$poste1->setTitre("Prouf");
$poste1->setType("Loloe");
$poste1->setDesc("Blablabla");
$poste1->setLieu("loin");
$poste1->setLimitDate(new \DateTime());
$poste1->setClosed();
$poste1->setCancelled(false);
$poste1->setPSE1(1);
$poste1->setPSE2(1);
$poste1->setDebut(new \DateTime());
$poste1->setFin(new \DateTime());

$sec1 = new Secouriste();
$sec1->setLogin("jacky");
$sec1->setNom("Thomas");
$sec1->setPrenom("LOL");
$sec1->setDDN(new \DateTime());
$sec1->setLDN(new \DateTime());
$sec1->setAdresse("loin");
$sec1->setEmail("LOL");
$sec1->setTel("00000");
$sec1->setSemestre("lskjvkojzqsenfdkl");
$sec1->setAdmin(false);

$inscr1 = new Inscription();
$inscr1->setSecouriste($sec1);
$inscr1->setPoste($poste1);
$inscr1->setValidee(false);

$sec1->addInscription($inscr1);
$poste1->addInscription($inscr1);

$entityManager->persist($sec1);
$entityManager->persist($poste1);
$entityManager->flush();

echo "Created DPS with ID " . $poste1->getId() . "\n";

?>