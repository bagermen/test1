<?php
namespace AlbumBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\NodeInterface;

/**
 * Class Configuration
 * @package PassBookBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return NodeInterface
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('album', 'array');

        $rootNode->children()
                ->scalarNode('driver')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('object_manager')->isRequired()->cannotBeEmpty()->end()
            ->end();

        $this->addClassesSection($rootNode);

        return $treeBuilder;
    }

    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('album')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('AlbumBundle\Entity\Album')->end()
                                ->scalarNode('repository')->defaultValue('AlbumBundle\Repository\AlbumRepository')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                        ->arrayNode('image')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('AlbumBundle\Entity\Image')->end()
                                ->scalarNode('repository')->defaultValue('AlbumBundle\Repository\ImageRepository')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
