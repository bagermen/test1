<?php

namespace AlbumBundle\Controller;

use AlbumBundle\Entity\Image;
use AlbumBundle\Services\ImagesService;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AlbumBundle\Entity\Album;

/**
 * Class ImagesController
 * @package AlbumBundle\Controller
 */
class ImagesController extends FOSRestController
{
    /**
     * @ParamConverter("album", class="AlbumBundle:Album")
     * @Annotations\View
     * @param Album $album
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getImagesAction(Album $album, Request $request)
    {
        /** @var ImagesService $service */
        $service = $this->get("images.service");

        /** @var Paginator $paginator */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $service->getQueryByAlbum($album),
            $request->query->getInt('page', 1),
            10
        );

        return $this->view(
            array("pagination" => $pagination),
            Response::HTTP_OK,
            array("Content-Type" => "application/json")
        )->setFormat("html");
    }

    /**
     * @ParamConverter("image", class="AlbumBundle:Image", options={"mapping": {"id": "image", "album": "album"}})
     * @Annotations\Get("/albums/{album}/image/{image}")
     * @Annotations\View
     * @param Image $image
     * @return \FOS\RestBundle\View\View
     */
    public function getImageAction(Image $image)
    {
        return $this->view(
            array("image" => $image),
            Response::HTTP_OK,
            array("Content-Type" => "application/json")
        )->setFormat("html");
    }
}