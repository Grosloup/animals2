<?php

namespace Site\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Temperature
 *
 * @ORM\Table(name="temperatures")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\TemperatureRepository")
 */
class Temperature
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
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Site\AdminBundle\Entity\House", inversedBy="temperatures")
     * @ORM\JoinColumn(name="bat_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $house;


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
     * Set value
     *
     * @param float $value
     * @return Temperature
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Temperature
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set house
     *
     * @param House $house
     * @return Temperature
     */
    public function setHouse(House $house = null)
    {
        $this->house = $house;

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
}
