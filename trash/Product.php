<?php
// src/Product.php

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity @Table(name="products")
**/
class Product
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
    * @ManyToOne(targetEntity="Buyer", inversedBy="products")
    */
    protected $buyer;
    /**
    * @ManyToMany(targetEntity="Color")
    */
    protected $color;

    public function __construct()
    {
        $this->color = new ArrayCollection();
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

    public function getBuyer()
    {
        return $this->buyer;
    }

    public function setBuyer($guy)
    {
        $guy->addProduct($this);
        $this->buyer = $guy;
    }

    public function setColor($col)
    {
        $this->color[] = $col;
    }

    public function getColor()
    {
        return $this->color;
    }
}

?>