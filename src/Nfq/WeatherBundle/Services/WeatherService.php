<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.7
 * Time: 00.53
 */

namespace Nfq\WeatherBundle\Services;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Providers\WeatherProviderInterface;

class WeatherService
{
    private $provider;

    public function __construct(WeatherProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function fetchCurrentWeather(Location $location):Weather
    {
        return $this->provider->fetchCurrentWeather($location);

    }

}