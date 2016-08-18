<?php

namespace AlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(
 *  name="image",
 *  indexes={
 *      @ORM\Index(name="image_name_idx", columns={"name"})
 *  },
 *  options={
 *      "comment":"Image table"
 *  }
 * )
 * @ORM\Entity(repositoryClass="AlbumBundle\Repository\ImageRepository")
 */
class Image
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
     *      "comment":"file name"
     *  }
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(
     *  name="file",
     *  type="string",
     *  length=255,
     *  options={
     *      "comment":"file path"
     *  }
     * )
     */
    private $file;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="images")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $album;


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
     * @return Image
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
     * @return Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param int $album
     * @return Image
     */
    public function setAlbum($album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @return Image
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
