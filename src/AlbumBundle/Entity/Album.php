<?php

namespace AlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 *
 * @ORM\Table(
 *  name="album",
 *  indexes={
 *      @ORM\Index(name="album_name_idx", columns={"name"})
 *  },
 *  options={
 *      "comment":"Album table"
 *  }
 * )
 * @ORM\Entity(repositoryClass="AlbumBundle\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(
     *  name="name",
     *  type="string",
     *  length=255,
     *  options={
     *      "comment":"Album name"
     *  }
     * )
     */
    private $name;

    /**
     * @var Image[]
     *
     * @ORM\OneToMany(
     *  targetEntity="Image",
     *  mappedBy="album",
     *  cascade={"remove", "persist"},
     *  orphanRemoval=true, fetch="EXTRA_LAZY"
     * )
     */
    private $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Album
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
     * @return Image[]
     */
    public function getImages()
    {
        return $this->images;
    }
}
