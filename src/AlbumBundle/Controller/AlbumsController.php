<?php

namespace AlbumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use AlbumBundle\Services\AlbumsService;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AlbumBundle\Entity\Album;

/**
 * Class AlbumsController
 * @package AlbumBundle\Controller
 */
class AlbumsController extends FOSRestController
{
    /**
     * @Annotations\View
     * @return \FOS\RestBundle\View\View
     */
    public function getAlbumsAction()
    {
        /** @var AlbumsService $service */
        $service = $this->get("albums.service");

        return $this->view(
            array("models" => $service->getAlbumList()),
            Response::HTTP_OK,
            array("Content-Type" => "application/json")
        )->setFormat("html");
    }

    /**
     * @ParamConverter("album", class="AlbumBundle:Album")
     * @Annotations\Get("/album/{album}")
     * @Annotations\View
     * @return \FOS\RestBundle\View\View
     * @param Album $album
     */
    public function getAlbumAction(Album $album)
    {
        return $this->view(
            array("model" => $album),
            Response::HTTP_OK,
            array("Content-Type" => "application/json")
        )->setFormat("html");
    }
}
