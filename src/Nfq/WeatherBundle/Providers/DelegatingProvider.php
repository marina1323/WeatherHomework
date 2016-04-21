<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.9
 * Time: 13.54
 */

namespace Nfq\WeatherBundle\Providers;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Exceptions\WeatherProviderException;


class DelegatingProvider implements WeatherProviderInterface
{

    private $providers;


    public function __construct(array $providers = array())
    {
            $this->providers=$providers;
    }


    public function fetchCurrentWeather(Location $location):Weather
    {
        foreach ($this->providers as $provider)
        {
            try
            {
                return $provider->fetchCurrentWeather($location);
            }
            catch(\Exception $e)
            {
                echo $e->getMessage();
            }
        }

        throw new WeatherProviderException("All providers didn't respond");
    }
}