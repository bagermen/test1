<?php
namespace AlbumBundle\Tests\Core;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use \Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RequestContext;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Class FunctionalTestCase
 * @package AlbumBundle\Tests\Tests\Core
 */
class FunctionalTestCase extends WebTestCase
{
    protected $router;

    /**
     * @inheritdoc
     */
    public function loadFixtureFiles(array $paths = array(), $append = false, $omName = null, $registryName = 'doctrine')
    {
        $result = parent::loadFixtureFiles($paths, $append, $omName, $registryName);
        $this->turnOnSQLiteForeignKeys();

        return $result;
    }

    /**
     * Get router
     *
     * @return Router
     */
    protected function getRouter()
    {
        if (empty($this->router)) {
            $this->router = $this->getContainer()->get('router');
            /** @var RequestContext $context */
            $context = $this->router->getContext();
            $context->setBaseUrl("");
        }

        return $this->router;
    }

    private function turnOnSQLiteForeignKeys()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $rsm = new ResultSetMapping();
        $query = $entityManager->createNativeQuery('PRAGMA foreign_keys = ON', $rsm);
        $query->getResult();
    }
}
