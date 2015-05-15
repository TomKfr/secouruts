<?php

use Doctrine\Common\Collections\ArrayCollection;

namespace Secouruts;

/** @Entity @Table(name="secouristes") */
class Secouriste
{
	/** @Id @Column(type="string") */
	protected $login;
	/** @Column(type="string") */
	protected $nom;
	/** @Column(type="string") */
	protected $prenom;
	/** @Column(type="datetime") */
	protected $ddn;
	/** @Column(type="string") */
	protected $ldn;
	/** @Column(type="string") */
	protected $adresse;
	/** @Column(type="string") */
	protected $email;
	/** @Column(type="string") */
	protected $tel;
	/** @Column(type="string") */
	protected $taille;
	/** @Column(type="string") */
	protected $semestre;
	/** @Column(type="boolean") */
	protected $isadmin;
	/** @Column(type="boolean") */
	protected $isPermis;
	/** @OneToMany(targetEntity="Diplome", mappedBy="id", cascade={"persist", "remove"}) */ //OneToMany unidirectionnel vers la classe diplome
	protected $diplomes;
	/** @ManyToMany(targetEntity="Creneau", mappedBy="secouristes")	 */ //ManyToOne bidirectionnel vers la classe créneau.
	protected $creneaux;

	public function __construct()
	{
		$this->diplomes = new \Doctrine\Common\Collections\ArrayCollection();
		//$this->inscriptions = new \Doctrine\Common\Collections\ArrayCollection();
	}

	//Gettesr & setters

	public function getLogin()
	{
		return $this->login;
	}
	public function setLogin($log)
	{
		$this->login = $log;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	public function setNom($n)
	{
		$this->nom = $n;
	}
	
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function setPrenom($p)
	{
		$this->prenom = $p;
	}
	
	public function getDDN()
	{
		return $this->ddn;
	}
	public function setDDN($daten)
	{
		$this->ddn = $daten;
	}
	
	public function getLDN()
	{
		return $this->ldn;
	}
	public function setLDN($lieun)
	{
		$this->ldn = $lieun;
	}

	public function getAdresse()
	{
		return $this->adresse;
	}
	public function setAdresse($adr)
	{
		$this->adresse = $adr;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($mail)
	{
		$this->email = $mail;
	}

	public function getTel()
	{
		return $this->tel;
	}
	public function setTel($t)
	{
		$this->tel = $t;
	}
	public function getTaille()
	{
		return $this->taille;
	}
	public function setTaille($size)
	{
		$this->taille=$size;
	}

	public function getSemestre()
	{
		return $this->semestre;
	}
	public function setSemestre($sem)
	{
		$this->semestre = $sem;
	}

	public function isAdmin()
	{
		return $this->isadmin;
	}
	public function setAdmin($admin)
	{
		$this->isadmin = $admin;
	}
	
	public function isPermis()
	{
		return $this->isPermis;
	}
	public function setPermis($permis)
	{
		$this->isPermis=$permis;
	}

	public function getDiplomes()
	{
		return $this->diplomes;
	}
	public function addDiplome($dip)
	{
		$this->diplomes[] = $dip;
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

	public function getDiplome($dip){ // Si l'utilisateur possède le diplome en paramètre, renvoie l'objet DateTime d'obtention, null sinon
		foreach ($this->diplomes as $diplom) {
			if($diplom->getType() == $dip) return $diplom->getDate();
		}
		return null;
	}
}

?>