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
     * @return array
     */
    public function getAlbumList()
    {
        return $this->albumRepository->findAll();
    }
}