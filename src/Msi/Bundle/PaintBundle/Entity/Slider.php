<?php

namespace Msi\Bundle\PaintBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="paint_slider")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Slider
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column()
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $pauseTime;

    /**
     * @ORM\Column(type="integer")
     */
    protected $slideSpeed;

    /**
     * @ORM\OneToMany(targetEntity="Slide", mappedBy="slider")
     */
    protected $slides;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->slides = new ArrayCollection();
        $this->pauseTime = 3000;
        $this->slideSpeed = 400;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getSlideSpeed()
    {
        return $this->slideSpeed;
    }

    public function setSlideSpeed($slideSpeed)
    {
        $this->slideSpeed = $slideSpeed;

        return $this;
    }

    public function getPauseTime()
    {
        return $this->pauseTime;
    }

    public function setPauseTime($pauseTime)
    {
        $this->pauseTime = $pauseTime;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlides()
    {
        return $this->slides;
    }

    public function setSlides($slides)
    {
        $this->slides = $slides;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
