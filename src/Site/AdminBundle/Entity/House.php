<?php

namespace Site\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * House
 *
 * @ORM\Table(name="houses")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\HouseRepository")
 */
class House
{
    /**
     * @ORM\OneToMany(targetEntity="Site\AdminBundle\Entity\Species", mappedBy="house")
     */
    protected $species;
    /**
     * @ORM\OneToMany(targetEntity="Site\AdminBundle\Entity\Enclosure", mappedBy="house")
     */
    protected $enclosures;

    /**
     * @ORM\OneToMany(targetEntity="Site\AdminBundle\Entity\Temperature", mappedBy="house")
     */
    protected $temperatures;

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
     * Constructor
     */
    public function __construct()
    {
        $this->species = new ArrayCollection();
        $this->enclosures = new ArrayCollection();
        $this->temperatures = new ArrayCollection();
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
     * @return House
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add species
     *
     * @param Species $species
     * @return House
     */
    public function addSpecie(Species $species)
    {
        $this->species[] = $species;

        return $this;
    }

    /**
     * Remove species
     *
     * @param Species $species
     */
    public function removeSpecie(Species $species)
    {
        $this->species->removeElement($species);
    }

    /**
     * Get species
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Add enclosures
     *
     * @param Enclosure $enclosures
     * @return House
     */
    public function addEnclosure(Enclosure $enclosures)
    {
        $this->enclosures[] = $enclosures;

        return $this;
    }

    /**
     * Remove enclosures
     *
     * @param Enclosure $enclosures
     */
    public function removeEnclosure(Enclosure $enclosures)
    {
        $this->enclosures->removeElement($enclosures);
    }

    /**
     * Get enclosures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnclosures()
    {
        return $this->enclosures;
    }

    public function __toString()
    {
        return $this->name;
    }


    /**
     * Add temperatures
     *
     * @param Temperature $temperatures
     * @return House
     */
    public function addTemperature(Temperature $temperatures)
    {
        $this->temperatures[] = $temperatures;

        return $this;
    }

    /**
     * Remove temperatures
     *
     * @param Temperature $temperatures
     */
    public function removeTemperature(Temperature $temperatures)
    {
        $this->temperatures->removeElement($temperatures);
    }

    /**
     * Get temperatures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemperatures()
    {
        return $this->temperatures;
    }
}
