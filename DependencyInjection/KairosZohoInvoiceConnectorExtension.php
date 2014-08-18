<?php

namespace Kairos\ZohoInvoiceConnectorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KairosZohoInvoiceConnectorExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('kairos_zoho_connector_bundle.auth_token', $config['auth_token']);
        $container->setParameter('kairos_zoho_connector_bundle.organization_id', $config['organization_id']);
        $container->setParameter('kairos_zoho_connector_bundle.default_tax_id', $config['default_tax_id']);
        $container->setParameter('kairos_zoho_connector_bundle.sandbox', $config['sandbox']);
    }
}
