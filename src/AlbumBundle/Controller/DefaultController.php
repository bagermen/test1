<?php

namespace AlbumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package AlbumBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
