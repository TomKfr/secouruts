<?php
// Class Inscription.php

namespace Secouruts;

/** @Entity @Table(name="inscriptions") */
class Inscription
{
	/** @Id @Column(type="integer") @GeneratedValue */
	protected $id;
	/** @ManyToOne(targetEntity="Secouriste", inversedBy="inscriptions") 
	*	@JoinColumn(name="secouriste_login", referencedColumnName="login", nullable=false)
	*/
	protected $secouriste;
	/** @ManyToOne(targetEntity="DPS", inversedBy="inscriptions") */
	protected $poste;
	/** @Column(type="boolean") */
	protected $estvalidee;

	public function __construct(){
		$this->setValidee(false);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getSecouriste()
	{
		return $this->secouriste;
	}
	public function setSecouriste($sec)
	{
		$this->secouriste = $sec;
	}

	public function getPoste()
	{
		return $this->poste;
	}
	public function setPoste($dps)
	{
		$this->poste = $dps;
	}

	public function estValidee()
	{
		return $this->estvalidee;
	}
	public function setValidee($valid)
	{
		$this->estvalidee = $valid;
	}
}

?>