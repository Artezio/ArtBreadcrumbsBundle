<?php
/**
 * Author: Paul Seleznev
 * Date: 1/07/2013
 */
namespace Art\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Art\BreadcrumbsBundle\Factory\BuilderFactory;

class ArtBreadcrumbsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('breadcrumbs.xml');

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('art_breadcrumbs.template', $config['template']);
        $container->setAlias('art_breadcrumbs.builder', $config['builder_service']);
        $container->setParameter('art_breadcrumbs.separator', $config['separator']);
        $container->setParameter('art_breadcrumbs.schema', $config['schema']);
        $container->setParameter('art_breadcrumbs.dev_mode', $config['dev_mode']);
    }

    public function getAlias()
    {
        return 'art_breadcrumbs';
    }
}