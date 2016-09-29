<?php

namespace AlbumBundle\Tests\Controller;

use AlbumBundle\Tests\Core\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class ImagesControllerTest
 * @package AlbumBundle\Tests\Controller
 */
class ImagesControllerTest extends FunctionalTestCase
{
    /**
     * Test get Images success
     */
    public function testGetImagesActionSuccess()
    {
        $this->loadFixtureFiles(array(
            '@AlbumBundle/DataFixtures/ORM/album.yml',
        ));

        /** @var \AlbumBundle\Repository\AlbumRepository $repository */
        $repository = $this->getContainer()->get('album.repository.album');
        /** @var \AlbumBundle\Entity\Album $album */
        $album = $repository->findOneBy(array());

        $client = static::createClient();
        $url = $this->getRouter()->generate(
            'albums_images_get_album_images',
            array(
                'album' => $album->getId()
            )
        );

        $client->request(
            Request::METHOD_GET,
            $url,
            array(
                'page' => 1,
                'page_size' => 3,
            )
        );
        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $data);
        $this->assertNotEmpty($data);
        $this->assertCount(3, $data['data']);
    }

    /**
     * Test get Images fail
     */
    public function testGetImagesActionFail()
    {
        $this->loadFixtureFiles(array(
            '@AlbumBundle/DataFixtures/ORM/album.yml',
        ));

        $client = static::createClient();
        $url = $this->getRouter()->generate(
            'albums_images_get_album_images',
            array(
                'album' => 'wrong'
            )
        );

        $client->request(
            Request::METHOD_GET,
            $url,
            array(
                'page' => 1,
                'page_size' => 3,
            )
        );
        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

}
