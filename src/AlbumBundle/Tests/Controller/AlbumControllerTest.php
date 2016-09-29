<?php

namespace AlbumBundle\Tests\Controller;

use AlbumBundle\Tests\Core\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class AlbumControllerTest
 * @package AlbumBundle\Tests\Controller
 */
class AlbumControllerTest extends FunctionalTestCase
{
    /**
     * Test get Albums
     */
    public function getAlbumsAction()
    {
        $this->loadFixtureFiles(array(
            '@AlbumBundle/DataFixtures/ORM/album.yml',
        ));

        $client = static::createClient();
        $url = $this->getRouter()->generate('albums_routes_get_albums');

        $client->request(Request::METHOD_GET, $url);
        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);

        $this->assertNotEmpty($data);
        $this->assertTrue(is_array($data));
    }

    /**
     * Test list action
     */
    public function testListAction()
    {
        $this->loadFixtureFiles(array(
            '@AlbumBundle/DataFixtures/ORM/album.yml',
        ));

        $client = static::createClient();
        $url = $this->getRouter()->generate('albums_routes_get_albums');

        $client->request(Request::METHOD_GET, $url);
        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);

        $this->assertNotEmpty($data);
        $this->assertTrue(is_array($data));
    }

}
