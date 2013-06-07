<?php

namespace Site\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Species
 *
 * @ORM\Table(name="species")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\SpeciesRepository")
 */
class Species
{
    /**
     * @ORM\OneToMany(targetEntity="Site\AdminBundle\Entity\Animal", mappedBy="species")
     */
    protected $animals;
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
     * @ORM\Column(name="name_en", type="string", length=255)
     */
    private $nameEn;
    /**
     * @var string
     *
     * @ORM\Column(name="name_la", type="string", length=255)
     */
    private $nameLa;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animals = new ArrayCollection();
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
     * @return Species
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set nameEn
     *
     * @param string $nameEn
     * @return Species
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameLa
     *
     * @return string
     */
    public function getNameLa()
    {
        return $this->nameLa;
    }

    /**
     * Set nameLa
     *
     * @param string $nameLa
     * @return Species
     */
    public function setNameLa($nameLa)
    {
        $this->nameLa = $nameLa;

        return $this;
    }

    /**
     * Add animals
     *
     * @param Animal $animals
     * @return Species
     */
    public function addAnimal(Animal $animals)
    {
        $this->animals[] = $animals;

        return $this;
    }

    /**
     * Remove animals
     *
     * @param Animal $animals
     */
    public function removeAnimal(Animal $animals)
    {
        $this->animals->removeElement($animals);
    }

    /**
     * Get animals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimals()
    {
        return $this->animals;
    }

    public function __toString()
    {
        return $this->name;
    }
}
