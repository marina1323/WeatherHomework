<?php


namespace Nfq\WeatherBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nfq_weather');

        $rootNode
            ->children()
              ->scalarNode('provider')->isRequired()
              ->validate()
              ->ifNotInArray(array('cached', 'delegating', 'openweathermap','yahoo'))
              ->thenInvalid('Invalid provider: %s')
              ->end()
               ->end()
                 ->arrayNode('providers')
                      ->children()
                        ->arrayNode('yahoo')->end()
                        ->arrayNode('openweathermap')
                          ->children()
                             ->scalarNode('api_key')->isRequired()->end()
                          ->end()
                       ->end()
                       ->arrayNode('delegating')
                           ->children()
                              ->arrayNode('providers')->isRequired()->cannotBeEmpty()->requiresAtLeastOneElement()
                                 ->prototype('scalar')
                                   ->validate()
                                     ->ifNotInArray(array('openweathermap','yahoo'))
                                       ->thenInvalid('Invalid provider: %s')
                                    ->end()
                                 ->end()
                              ->end()
                           ->end()
                        ->end()
                        ->arrayNode('cached')
                            ->children()
                                ->scalarNode('provider')->isRequired()
                                  ->validate()
                                    ->ifNotInArray(array('delegating', 'openweathermap','yahoo'))
                                      ->thenInvalid('Invalid provider: %s')
                                      ->end()
                                ->end()
                                ->integerNode('ttl')->isRequired()->end()
                            ->end()
                         ->end()
                       ->end()
                  ->end()
            ->end();



        return $treeBuilder;
    }




}