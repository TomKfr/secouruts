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
	/** @OneToMany(targetEntity="Creneau", mappedBy="poste", cascade={"persist", "remove"}) */
	protected $creneaux;
	/** @OneToMany(targetEntity="Inscription", mappedBy="poste", cascade={"persist", "remove"}) */
	protected $inscriptions;

	public function __construct()
	{
		$this->creneaux = new \Doctrine\Common\Collections\ArrayCollection();
		//Générer les créneaux dès la construction ?
		$this->inscriptions = new \Doctrine\Common\Collections\ArrayCollection();
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
	public function setCancelled($can)
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

	public function getCreneaux()
	{
		return $this->creneaux;
	}
	public function addCreneau($cre)
	{
		$this->creneaux[] = $cre;
	}

	public function getInscriptions()
	{
		return $this->inscriptions;
	}
	public function addInscription($inscr)
	{
		$this->inscriptions[] = $inscr;
	}

	//Other methods

}

?>