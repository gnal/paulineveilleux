<?php

namespace Msi\Bundle\PaintBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Msi\Bundle\CmfBundle\Tools\Cutter;
use Msi\Bundle\CmfBundle\Model\FileInterface;

/**
 * @ORM\Table(name="paint_slide")
 * @ORM\Entity
 */
class Slide implements FileInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $filename;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $published;

    /**
     * @ORM\ManyToOne(targetEntity="Slider", inversedBy="slides")
     */
    protected $slider;

    protected $uploadDir = 'slides';

    protected $file;

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
        $this->position = 1;
        $this->published = false;
    }

    public function getPath()
    {
        return $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->uploadDir;
    }

    public function getPathname($prefix = '')
    {
        return '/uploads/'.$this->uploadDir.'/'.$prefix.$this->filename;
    }

    public function getAllowedExt()
    {
        return array('jpg', 'jpeg', 'gif', 'png');
    }

    public function processFile(\SplFileInfo $file)
    {
        $cutter = new Cutter();
        $cutter->setFile($file)->resize(500, 300)->save();
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        $this->updatedAt = new \DateTime();

        return $this;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getSlider()
    {
        return $this->slider;
    }

    public function setSlider($slider)
    {
        $this->slider = $slider;

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

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string) $this->filename;
    }
}
