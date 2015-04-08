<?php
// model/Product.php

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity @Table(name="buyers")
**/
class Buyer
{
	/**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    /**
     * @Column(type="string")
     */
    protected $name;
    /**
    * @OnetoMany(targetEntity="Product", mappedBy="buyer")
    */
    protected $products;

    public function __construct()
    {
    	$this->products = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getProducts()
    {
    	return $this->products;
    }

    public function addProduct($prod)
    {
    	$this->products[] = $prod;
    }
}

?>