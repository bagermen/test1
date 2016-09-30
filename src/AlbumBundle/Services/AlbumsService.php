<?php

namespace AlbumBundle\Services;

use AlbumBundle\Repository\AlbumRepository;

/**
 * Class AlbumsService
 * @package AlbumBundle\Services
 */
class AlbumsService
{
    protected $albumRepository;

    /**
     * @param AlbumRepository $albumRepository
     */
    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    /**
     * Albums list
     * @param int $maxImages
     * @return array
     */
    public function getAlbumList($maxImages = 0)
    {
        return ($maxImages <= 0)
            ? $this->albumRepository->findAll()
            : $this->albumRepository->filterByMaxImagesPerAlbum($maxImages);
    }
}