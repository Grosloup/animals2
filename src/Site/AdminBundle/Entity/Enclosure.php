<?php

namespace Site\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enclosure
 *
 * @ORM\Table(name="enclosures")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\EnclosureRepository")
 */
class Enclosure
{
    /**
     * @ORM\ManyToOne(targetEntity="Site\AdminBundle\Entity\House", inversedBy="enclosures")
     * @ORM\JoinColumn(name="house_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $house;
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
     * @return Enclosure
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get house
     *
     * @return House
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set house
     *
     * @param House $house
     * @return Enclosure
     */
    public function setHouse(House $house = null)
    {
        $this->house = $house;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
