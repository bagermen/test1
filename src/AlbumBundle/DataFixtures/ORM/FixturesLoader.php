<?php
namespace AlbumBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

/**
 * Class FixturesLoader
 * @package AlbumBundle\DataFixtures\ORM
 */
class FixturesLoader extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/album.yml',
        );
    }
}