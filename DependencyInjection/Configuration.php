<?php
/**
 * Author: Paul Seleznev
 * Date: 1/07/2013
 */
namespace Art\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('art_breadcrumbs');

        $rootNode
            ->children()
                ->scalarNode('template')
                    ->cannotBeEmpty()
                    ->defaultValue('ArtBreadcrumbsBundle::art_breadcrumbs.html.twig')
                ->end()
                ->scalarNode('schema')
                    ->cannotBeEmpty()
                    ->defaultValue('%kernel.root_dir%/config/breadcrumbs.yml')
                ->end()
                ->scalarNode('builder_service')
                    ->defaultValue('art_breadcrumbs.yml_builder')
                ->end()
                ->scalarNode('separator')
                    ->defaultValue('/')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }
}