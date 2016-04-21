<?php


namespace Nfq\WeatherBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;

class NfqWeatherExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');


        $provider = $config['provider'];
        $container->setAlias('nfq_weather.provider', 'nfq_weather.provider.'.$provider);
        $container->setParameter('ttl', $config['providers']['cached']['ttl']);
        $container->setParameter('nfq_weather.delegating_providers', $config['providers']['delegating']['providers']);
        $container->setParameter('nfq_weather.cached_provider', $config['providers']['cached']['provider']);
        $container->setParameter('file', $container->getParameter('kernel.root_dir') . '/cache/weather/weather.txt');
    }

}