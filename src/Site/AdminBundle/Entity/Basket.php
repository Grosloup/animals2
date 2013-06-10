<?php

namespace Site\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Basket
 *
 * @ORM\Table(name="baskets")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\BasketRepository")
 */
class Basket
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
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orderAt", type="datetime")
     */
    private $orderAt;
    /**
     *
     * @ORM\ManyToMany(targetEntity="Site\AdminBundle\Entity\Product", inversedBy="baskets")
     * @ORM\JoinTable(name="baskets_products")
     */
    private $products;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliverAt", type="datetime")
     */
    private $deliverAt;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Site\AdminBundle\Entity\BasketState", inversedBy="baskets")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $state;
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Basket
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get orderAt
     *
     * @return \DateTime
     */
    public function getOrderAt()
    {
        return $this->orderAt;
    }

    /**
     * Set orderAt
     *
     * @param \DateTime $orderAt
     * @return Basket
     */
    public function setOrderAt($orderAt)
    {
        $this->orderAt = $orderAt;

        return $this;
    }

    /**
     * Get products
     *
     * @return string
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set products
     *
     * @param string $products
     * @return Basket
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get deliverAt
     *
     * @return \DateTime
     */
    public function getDeliverAt()
    {
        return $this->deliverAt;
    }

    /**
     * Set deliverAt
     *
     * @param \DateTime $deliverAt
     * @return Basket
     */
    public function setDeliverAt($deliverAt)
    {
        $this->deliverAt = $deliverAt;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Basket
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Basket
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Add products
     *
     * @param Product $products
     * @return Basket
     */
    public function addProduct(Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param Product $products
     */
    public function removeProduct(Product $products)
    {
        $this->products->removeElement($products);
    }
}
