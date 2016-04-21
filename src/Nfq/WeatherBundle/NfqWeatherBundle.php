<?php

namespace Nfq\WeatherBundle;

use Nfq\WeatherBundle\DependencyInjection\Compiler\NfqWeatherPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NfqWeatherBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new NfqWeatherPass());
    }
}
