<?php

namespace AlbumBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AlbumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlbumRepository extends EntityRepository
{
    /**
     * Return list of albums with max images specified
     * @param int $imageCount number of images per album
     * @return array
     */
    public function filterByMaxImagesPerAlbum($imageCount = 0)
    {
        if ($imageCount <= 0) {
            return array();
        }

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('a')
            ->from($this->getEntityName(), 'a')
            ->innerJoin('a.images', 'i')
            ->groupBy('a')
            ->having($qb->expr()->lte('COUNT(i)', ':images'))
            ->setParameter('images', $imageCount);

        return $qb->getQuery()->getResult();
    }
}
