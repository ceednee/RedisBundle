<?php

namespace Highco\Bundle\RedisBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();

        $tb
            ->root('highco_redis', 'array')
                ->children()
                    ->arrayNode('connection')
                        ->children()
                            ->scalarNode('host')->isRequired()->end()
                            ->scalarNode('port')->isRequired()->end()
                            ->scalarNode('database')->defaultValue('0')->end()
                            ->scalarNode('timeout')->defaultValue('2')->end()
                        ->end()
                    ->end()
                ->end()
                ->children()
                    ->arrayNode('options')
                        ->useAttributeAsKey('options')->prototype('scalar')->end()
                    ->end()
                ->end()

                ->children()
                    ->scalarNode('adapter_class')->end()
                ->end()
            ->end()
        ;

        return $tb;
    }
}
