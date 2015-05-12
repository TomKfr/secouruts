<?php
// Class Creneaux.php

use Doctrine\Common\Collections\ArrayCollection;

namespace Secouruts;

/** @Entity @Table(name="creneau") */
class Creneau
{
	/** @Id @Column(type="integer") @GeneratedValue */
	protected $id;
	/** @ManyToOne(targetEntity="DPS", inversedBy="creneau") */
	protected $poste;
	/** @ManyToMany(targetEntity="Secouriste")
	*	@JoinTable(name="secouristes_creneaux",
	*	joinColumns={@JoinColumn(name="creneau_id", referencedColumnName="id", nullable=false)},
	*	inverseJoinColumns={@JoinColumn(name="secouriste_login", referencedColumnName="login", nullable=false)}
	*	)
	*/
	protected $secouristes;
	/** @Column(type="datetime") */
	protected $datedeb;
	/** @Column(type="datetime") */
	protected $datefin;

	public function __construct()
	{
		$this->secouristes = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPoste()
	{
		return $this->poste;
	}
	public function setPoste($dps)
	{
		$this->poste = $dps;
	}

	public function getSecouristes()
	{
		return $this->secouristes;
	}
	public function addSecouriste($sec)
	{
		$this->secouristes[] = $sec;
	}
	public function removeSecouriste($sec)
	{
		$this->secouristes->removeElement($sec);
	}
	public function secouristeInscrit($sec)
	{
		return $this->secouristes->contains($sec);
	}
	public function nbSecInscrits()
	{
		return $this->secouristes->count();
	}

	public function getDateDeb()
	{
		return $this->datedeb;
	}
	public function setDateDeb($deb)
	{
		$this->datedeb = $deb;
	}

	public function getDateFin()
	{
		return $this->datefin;
	}
	public function setDateFin($fin)
	{
		$this->datefin = $fin;
	}
}

?>