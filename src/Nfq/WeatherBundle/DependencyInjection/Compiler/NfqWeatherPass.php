<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.20
 * Time: 15.29
 */

namespace Nfq\WeatherBundle\DependencyInjection\Compiler;


use Exception;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class NfqWeatherPass implements CompilerPassInterface
{


    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('nfq_weather.provider.delegating');

        $providers = array();

        foreach ($container->getParameter('nfq_weather.delegating_providers') as $provider)
        {
            $providers[] = new Reference('nfq_weather.provider.'.$provider);
        }

        $definition->replaceArgument(0, $providers);

        $container->getDefinition('nfq_weather.provider.cached')
            ->addMethodCall('getFile', [$container->getParameter('file')])
            ->replaceArgument(0, new Reference('nfq_weather.provider.'.$container->getParameter('nfq_weather.cached_provider')));
    }
}