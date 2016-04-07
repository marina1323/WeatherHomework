<?php


namespace Nfq\WeatherBundle\Providers;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;


interface WeatherProviderInterface
{
    public function fetchCurrentWeather(Location $location):Weather;

}