<?php

namespace Kairos\ZohoInvoiceConnectorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kairos_zoho_invoice_connector');

        $rootNode
            ->children()
                ->scalarNode('auth_token')
                    ->isRequired()->cannotBeEmpty()
                    ->info('Your zoho auth token')
                ->end()
                ->scalarNode('organization_id')
                    ->isRequired()->cannotBeEmpty()
                    ->info('Zoho api organization id')
                ->end()
                ->scalarNode('default_tax_id')
                    ->info('default tax id')
                ->end()
                ->booleanNode('sandbox')
                    ->info('Sandbox mode')
                    ->defaultTrue()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
