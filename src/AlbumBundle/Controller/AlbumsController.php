<?php

namespace AlbumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use AlbumBundle\Services\AlbumsService;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AlbumBundle\Entity\Album;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AlbumsController
 * @package AlbumBundle\Controller
 */
class AlbumsController extends FOSRestController
{
    /**
     * @Annotations\View
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getAlbumsAction(Request $request)
    {
        /** @var AlbumsService $service */
        $service = $this->get("albums.service");

        return $this->view(
            array("models" => $service->getAlbumList($request->query->getInt('filter', 0))),
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
