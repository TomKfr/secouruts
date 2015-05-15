<?php
// Class DPS.php

use Doctrine\Common\Collections\ArrayCollection;

namespace Secouruts;

/** @Entity @Table(name="dps") */
class DPS
{
	/** @Id @Column(type="integer") @GeneratedValue */
	protected $id;
	/** @Column(type="string") */
	protected $titre;
	/** @Column(type="string") */
	protected $type;
	/** @Column(type="string") */
	protected $description;
	/** @Column(type="string") */
	protected $lieu;
	/** @Column(type="date") */
	protected $limit_date;
	/** @Column(type="boolean") */
	protected $isclosed;
	/** @Column(type="boolean") */
	protected $iscancelled;
	/** @Column(type="integer") */
	protected $nbpse1;
	/** @Column(type="integer") */
	protected $nbpse2;
	/** @Column(type="datetime") */
	protected $debut;
	/** @Column(type="datetime") */
	protected $fin;
	/** @Column(type="string") */
	protected $client;
	/** @OneToMany(targetEntity="Creneau", mappedBy="poste", cascade={"persist", "remove"}, orphanRemoval=true) */
	protected $creneaux;

	public function __construct()
	{
		$this->creneaux = new \Doctrine\Common\Collections\ArrayCollection();

		$this->setClosed(false);
		$this->setCancelled(false);
	}

	//Getters & setters

	public function getId()
	{
		return $this->id;
	}

	public function getTitre()
	{
		return $this->titre;
	}
	public function setTitre($titr)
	{
		$this->titre = $titr;
	}

	public function getType()
	{
		return $this->type;
	}
	public function setType($typ)
	{
		$this->type = $typ;
	}

	public function getDesc()
	{
		return $this->description;
	}
	public function setDesc($desc)
	{
		$this->description = $desc;
	}

	public function getLieu()
	{
		return $this->lieu;
	}
	public function setLieu($li)
	{
		$this->lieu = $li;
	}

	public function getLimitDate()
	{
		return $this->limit_date;
	}
	public function setLimitDate($limdat)
	{
		if(!isset($limdat)) $limdat = date('d/m/y', mktime(0, 0, 0, date("m")+2, date("d"), date("Y")));
		$this->limit_date = $limdat;
	}

	public function isClosed()
	{
		return $this->isclosed;
	}
	public function setClosed($clo = false)
	{
		$this->isclosed = $clo;
	}

	public function isCancelled()
	{
		return $this->iscancelled;
	}
	public function setCancelled($can = false)
	{
		$this->iscancelled = $can;
	}

	public function getPSE1()
	{
		return $this->nbpse1;
	}
	public function setPSE1($nb1)
	{
		$this->nbpse1 = $nb1;
	}

	public function getPSE2()
	{
		return $this->nbpse2;
	}
	public function setPSE2($nb2)
	{
		$this->nbpse2 = $nb2;
	}

	public function getDebut()
	{
		return $this->debut;
	}
	public function setDebut($deb)
	{
		$this->debut = $deb;
	}

	public function getFin()
	{
		return $this->fin;
	}
	public function setFin($fn)
	{
		$this->fin = $fn;
	}
	public function getClient()
	{
		return $this->client;
	}
	public function setClient($clt)
	{
		$this->client = $clt;
	}
	public function getCreneaux()
	{
		return $this->creneaux;
	}
	public function addCreneau($cre)
	{
		$cre->setPoste($this);
		$this->creneaux[] = $cre;
	}

	public function getCreneau($id)
	{
		foreach ($this->creneaux as $cre) {
			if ($cre->getId() == $id) return $cre;
		}
		return null;
	}

	//Other methods

	public function genererCreneaux(){ //Création et ajout des créneaux en fonction des dates ...

		if($this->debut !== null && $this->fin !== null){ //On vérifie que les dates sont en place sinon, on ne fait rien !
			$this->creneaux->clear();

			$base_interval = new \DateInterval('PT2H');

			$start_date = clone $this->debut; //new DateTime('05/23/2015 12:15');
			$end_date = clone $this->fin; //new DateTime('05/22/2015 22:22');

			$current_date = $start_date;
			$current_diff = $current_date->diff($end_date);

			$diff_d = 0;
			$diff_h = 0;
			$diff_m = 0;

			if($current_diff->invert == 0) {
				$diff_d = $current_diff->format('%d');
				$diff_h = $current_diff->format('%h');

				while($diff_d >= 1 || $diff_h >= 2){
					//echo "Nouvel intervalle\n";
					$cre = new Creneau();

					//echo "Date de debut :".$current_date->format('d M Y H:i')."\n";
					$cre->setDateDeb(clone $current_date);

					$current_date->add($base_interval);
					//echo "Date de fin : ".$current_date->format('d M Y H:i')."\n\n";
					$cre->setDateFin(clone $current_date);

					$this->addCreneau($cre);

					$current_diff = $current_date->diff($end_date, true);
					$diff_d = $current_diff->format('%d');
					$diff_h = $current_diff->format('%h');
				}

				$diff_m = $current_diff->format('%m');

				if($diff_h >= 1 || $diff_m >= 1){
					// echo "Intervalle final :\n";
					// echo "Date de debut :".$current_date->format('d M Y H:i')."\n";
					// echo "Date de fin : ".$end_date->format('d M Y H:i')."\n\n";

					$cre = new Creneau();
					$cre->setDateDeb(clone $current_date);
					$cre->setDateFin(clone $end_date);
					$this->addCreneau($cre);
				}
			}
		}
	}

	public function checkSecIncsr($sec) //Vérifie si le secouriste est dans les créneaux du poste
	{
		foreach ($this->creneaux as $creneau) {
			if($creneau->secouristeInscrit($sec)) return true;
		}

		return false;
	}

	public function closeIfPassed(){ // Clos les inscriptions au poste si la date limite d'inscription a été atteinte.
		if(!is_null($this->limit_date)){
			if($this->limit_date->diff(new \DateTime())->invert == 0) $this->setClosed(true);
		}
	}

	public function date_passed(){ // Renvoie true si la date de fin du poste a été dépassée.
		if(!is_null($this->fin)){
			if($this->fin->diff(new \DateTime())->invert == 0) return true;
			else return false;
		}
	}
}

?>