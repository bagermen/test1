<?php

namespace AlbumBundle;

use AlbumBundle\DependencyInjection\AlbumExtension;
use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

/**
 * Class AlbumBundle
 * @package AlbumBundle
 */
class AlbumBundle extends AbstractResourceBundle
{
    protected $mappingFormat = self::MAPPING_ANNOTATION;

    /**
     * Return an array which contains the supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        );
    }

    /**
     * @inheritdoc
     * @return AlbumExtension
     */
    public function getContainerExtension()
    {
        if ($this->extension === null) {
            $this->extension = new AlbumExtension();
        }

        return $this->extension;
    }

    protected function getModelNamespace()
    {
        return 'AlbumBundle\Entity';
    }

    /**
     * Return the absolute path where are stored the doctrine mapping.
     *
     * @return string
     */
    protected function getConfigFilesPath()
    {
        return sprintf(
            '%s/Entity',
            $this->getPath()
        );
    }
}
