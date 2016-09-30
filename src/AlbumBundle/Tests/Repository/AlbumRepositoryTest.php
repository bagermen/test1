<?php

namespace AlbumBundle\Tests\Repository;

use AlbumBundle\Tests\Core\FunctionalTestCase;

/**
 * Class AlbumRepositoryTest
 * @package AlbumBundle\Tests\Repository
 */
class AlbumRepositoryTest extends FunctionalTestCase
{
    /**
     * Test filter by images
     * @dataProvider getImagesNumbersProvider
     * @param int $less
     * @param int $equal
     * @param int $more
     */
    public function testFilterByMaxImages($less, $equal, $more)
    {
        $this->loadFixtureFiles(array(
            '@AlbumBundle/DataFixtures/ORM/oneAlbum.yml',
        ));

        /** @var \AlbumBundle\Repository\AlbumRepository $repository */
        $repository = $this->getContainer()->get('album.repository.album');

        $this->assertCount(1, $repository->filterByMaxImagesPerAlbum($less));
        $this->assertCount(1, $repository->filterByMaxImagesPerAlbum($equal));
        $this->assertCount(1, $repository->filterByMaxImagesPerAlbum($more));
    }

    /**
     * @return array
     */
    public function getImagesNumbersProvider()
    {
        /** @var \AlbumBundle\Repository\ImageRepository $repository */
        $repository = $this->getContainer()->get('album.repository.image');

        $images = (int) $repository->createQueryBuilder('i')
            ->select('count(i.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return array(
            array($images - 1, $images, $images + 1),
        );
    }
}