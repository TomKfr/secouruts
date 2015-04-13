<?php
// Class Diplome.php

namespace Secouruts;

/** @Entity @Table(name="diplomes") */
class Diplome
{
	/** @Id @Column(type="integer") @GeneratedValue */
	protected $id;
	/** @Column(type="string") */
	protected $type;
	/** @Column(type="date") */
	protected $date;

	public function getId()
	{
		return $this->id;
	}

	public function getType()
	{
		return $this->type;
	}
	public function setType($typ)
	{
		$this->type = $typ;
	}

	public function getDate()
	{
		return $this->date;
	}
	public function setDate($dat)
	{
		$this->date = $dat;
	}

}

?>