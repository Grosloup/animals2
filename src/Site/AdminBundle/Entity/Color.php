<?php

namespace Site\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 *
 * @ORM\Table(name="colors")
 * @ORM\Entity(repositoryClass="Site\AdminBundle\Entity\ColorRepository")
 */
class Color
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
     * @ORM\Column(name="foreground", type="string", length=10)
     */
    private $foreground;

    /**
     * @var string
     *
     * @ORM\Column(name="background", type="string", length=10)
     */
    private $background;


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
     * @return Color
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
     * Set foreground
     *
     * @param string $foreground
     * @return Color
     */
    public function setForeground($foreground)
    {
        $this->foreground = $foreground;

        return $this;
    }

    /**
     * Get foreground
     *
     * @return string
     */
    public function getForeground()
    {
        return $this->foreground;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return Color
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string
     */
    public function getBackground()
    {
        return $this->background;
    }

    public function __toString()
    {
        return $this->name;
    }
}