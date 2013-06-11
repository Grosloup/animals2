<?php

namespace Site\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;
    /**
     * @ORM\ManyToOne(targetEntity="Site\AdminBundle\Entity\ProductType", inversedBy="products")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="packaging", type="string", length=255, nullable=true)
     */
    private $packaging;
    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    /**
     *
     * @ORM\ManyToMany(targetEntity="Site\AdminBundle\Entity\Basket", mappedBy="baskets")
     */
    private $baskets;

    /**
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baskets = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Product
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get type
     *
     * @return ProductType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param ProductType $type
     * @return Product
     */
    public function setType(ProductType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get packaging
     *
     * @return string
     */
    public function getPackaging()
    {
        return $this->packaging;
    }

    /**
     * Set packaging
     *
     * @param string $packaging
     * @return Product
     */
    public function setPackaging($packaging)
    {
        $this->packaging = $packaging;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Add baskets
     *
     * @param Basket $baskets
     * @return Product
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}