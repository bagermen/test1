<?php
namespace AlbumBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class AlbumExtension
 * @package Petrosoft\PassBookSubscriptionBundle\DependencyInjection
 */
class AlbumExtension extends AbstractResourceExtension
{
    protected $applicationName = 'album';

    protected $configFiles = array(
        'services.yml',
    );

    /**
     * {@inheritdoc}
     * @return string
     */
    public function getAlias()
    {
        return $this->applicationName;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configure(
            $config,
            new Configuration(),
            $container,
            self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS
        );
    }

    protected function process(array $config, ContainerBuilder $container)
    {
        return $config;
    }
}
