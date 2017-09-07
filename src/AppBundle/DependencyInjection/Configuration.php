<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 07.04.17
 * Time: 11:05
 */

namespace AppBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('app');

        $rootNode
            ->children()
                ->arrayNode("teams")
                    ->requiresAtLeastOneElement()
                    ->prototype("array")
                        ->children()
                            ->scalarNode('symbol')->isRequired(true)->end()
                            ->scalarNode('segment_id')->isRequired(true)->end()
                            ->scalarNode('intercom_api_key')->isRequired(true)->end()
                            ->scalarNode('intercom_app_id')->isRequired(true)->end()
                            ->scalarNode('admin_panel_link')->isRequired(true)->end()
                            ->scalarNode('support_tickets_link')->isRequired(true)->end()
                            ->scalarNode('crm_link')->isRequired(true)->end()
                            ->arrayNode('promotions')
                                ->children()
                                    ->scalarNode('url')->isRequired(false)->end()
                                    ->scalarNode('service')->isRequired(false)->end()
                                ->end()
                            ->end()
                            ->arrayNode('api')
                                ->children()
                                    ->scalarNode('api_login')->isRequired(false)->end()
                                    ->scalarNode('api_password')->isRequired(false)->end()
                                    ->scalarNode('api_secret')->isRequired(false)->end()
                                    ->scalarNode('api_url')->isRequired(false)->end()
                                    ->scalarNode("api_service")->isRequired(false)->end()
                                    ->scalarNode("email_template")->isRequired(false)->end()
                                ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}