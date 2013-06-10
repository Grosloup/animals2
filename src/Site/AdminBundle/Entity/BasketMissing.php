<?php

namespace Site\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BasketMissing
 *
 * @ORM\Table(name="baskets_missings")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\BasketMissingRepository")
 */
class BasketMissing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="basket", type="string", length=255)
     */
    private $basket;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255)
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     */
    private $weight;

    /**
     * @var integer
     *
     * @ORM\Column(name="unit", type="integer")
     */
    private $unit;

    /**
     * @var integer
     *
     * @ORM\Column(name="package", type="integer")
     */
    private $package;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set basket
     *
     * @param string $basket
     * @return BasketMissing
     */
    public function setBasket($basket)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Get basket
     *
     * @return string
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * Set product
     *
     * @param string $product
     * @return BasketMissing
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set weight
     *
     * @param float $weight
     * @return BasketMissing
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set unit
     *
     * @param integer $unit
     * @return BasketMissing
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return integer
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set package
     *
     * @param integer $package
     * @return BasketMissing
     */
    public function setPackage($package)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return integer
     */
    public function getPackage()
    {
        return $this->package;
    }
}
