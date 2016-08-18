<?php

namespace AlbumBundle\Services;

use AlbumBundle\Entity\Album;
use AlbumBundle\Repository\ImageRepository;

/**
 * Class ImagesService
 * @package AlbumBundle\Services
 */
class ImagesService
{
    protected $imageRepository;

    /**
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * Albums list query
     * @param Album $album
     * @return array
     */
    public function getQueryByAlbum(Album $album)
    {
        return $this->imageRepository->findByQuery(array("album" => $album->getId()));
    }
}