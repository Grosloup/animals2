<?php

namespace Site\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * BaasketState
 *
 * @ORM\Table(name="basket_states")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\BasketStateRepository")
 */
class BasketState
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Site\AdminBundle\Entity\Basket", mappedBy="state")
     */
    private $baskets;


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
     * Set name
     *
     * @param string $name
     * @return BasketState
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baskets = new ArrayCollection();
    }

    /**
     * Add baskets
     *
     * @param Basket $baskets
     * @return BasketState
     */
    public function addBasket(Basket $baskets)
    {
        $this->baskets[] = $baskets;

        return $this;
    }

    /**
     * Remove baskets
     *
     * @param Basket $baskets
     */
    public function removeBasket(Basket $baskets)
    {
        $this->baskets->removeElement($baskets);
    }

    /**
     * Get baskets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBaskets()
    {
        return $this->baskets;
    }
}
