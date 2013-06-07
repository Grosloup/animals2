<?php

namespace Site\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Animal
 *
 * @ORM\Table(name="animals")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\AnimalRepository")
 */
class Animal
{
    /**
     * @ORM\OneToMany(targetEntity="Site\AdminBundle\Entity\Post", mappedBy="animal")
     * @ORM\OrderBy({"date"="DESC"})
     */
    protected $events;
    /**
     * @ORM\ManyToOne(targetEntity="Site\AdminBundle\Entity\Species", inversedBy="animals")
     * @ORM\JoinColumn(name="species_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $species;
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="chip", type="string", length=255, nullable=true)
     */
    private $chip;
    /**
     * @var string
     *
     * @ORM\Column(name="collar", type="string", length=255, nullable=true)
     */
    private $collar;
    /**
     * @var string
     *
     * @ORM\Column(name="earring", type="string", length=255, nullable=true)
     */
    private $earring;
    /**
     * @var string
     *
     * @ORM\Column(name="zims", type="string", length=255, nullable=true)
     */
    private $zims;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="datetime", nullable=true)
     */
    private $birth;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="indate", type="datetime", nullable=true)
     */
    private $indate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="outdate", type="datetime", nullable=true)
     */
    private $outdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="death", type="datetime", nullable=true)
     */
    private $death;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
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
     * @return Animal
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get chip
     *
     * @return string
     */
    public function getChip()
    {
        return $this->chip;
    }

    /**
     * Set chip
     *
     * @param string $chip
     * @return Animal
     */
    public function setChip($chip)
    {
        $this->chip = $chip;

        return $this;
    }

    /**
     * Get collar
     *
     * @return string
     */
    public function getCollar()
    {
        return $this->collar;
    }

    /**
     * Set collar
     *
     * @param string $collar
     * @return Animal
     */
    public function setCollar($collar)
    {
        $this->collar = $collar;

        return $this;
    }

    /**
     * Get earring
     *
     * @return string
     */
    public function getEarring()
    {
        return $this->earring;
    }

    /**
     * Set earring
     *
     * @param string $earring
     * @return Animal
     */
    public function setEarring($earring)
    {
        $this->earring = $earring;

        return $this;
    }

    /**
     * Get zims
     *
     * @return string
     */
    public function getZims()
    {
        return $this->zims;
    }

    /**
     * Set zims
     *
     * @param string $zims
     * @return Animal
     */
    public function setZims($zims)
    {
        $this->zims = $zims;

        return $this;
    }

    /**
     * Get birth
     *
     * @return string
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set birth
     *
     * @param string $birth
     * @return Animal
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;

        return $this;
    }

    /**
     * Get indate
     *
     * @return \DateTime
     */
    public function getIndate()
    {
        return $this->indate;
    }

    /**
     * Set indate
     *
     * @param \DateTime $indate
     * @return Animal
     */
    public function setIndate($indate)
    {
        $this->indate = $indate;

        return $this;
    }

    /**
     * Get outdate
     *
     * @return \DateTime
     */
    public function getOutdate()
    {
        return $this->outdate;
    }

    /**
     * Set outdate
     *
     * @param \DateTime $outdate
     * @return Animal
     */
    public function setOutdate($outdate)
    {
        $this->outdate = $outdate;

        return $this;
    }

    /**
     * Get death
     *
     * @return \DateTime
     */
    public function getDeath()
    {
        return $this->death;
    }

    /**
     * Set death
     *
     * @param \DateTime $death
     * @return Animal
     */
    public function setDeath($death)
    {
        $this->death = $death;

        return $this;
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
     * @return Animal
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Add events
     *
     * @param Post $events
     * @return Animal
     */
    public function addEvent(Post $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param Post $events
     */
    public function removeEvent(Post $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Get species
     *
     * @return Species
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set species
     *
     * @param Species $species
     * @return Animal
     */
    public function setSpecies(Species $species = null)
    {
        $this->species = $species;

        return $this;
    }

    public function __toString()
    {
        if ($this->name != null) {
            return $this->name;
        } elseif ($this->chip != null) {
            return $this->chip;
        } elseif ($this->earring != null) {
            return $this->earring;
        } elseif ($this->collar != null) {
            return $this->collar;
        } elseif ($this->zims != null) {
            return $this->zims;
        } else {
            return "inconnu";
        }
    }
}
