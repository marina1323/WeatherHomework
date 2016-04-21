<?php


namespace Nfq\WeatherBundle\Providers;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Parsers\OpenWeatherMapDataParser;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    private $parser;
    private $apiKey;

    public function __construct(OpenWeatherMapDataParser $parser, string $apiKey)
    {
        $this->parser = $parser;
        $this->apiKey = $apiKey;
    }

    public function fetchCurrentWeather(Location $location):Weather
    {
        $url = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $location->getLatitude() .'&lon=' . $location->getLongitude(). '&appid=' . $this->apiKey . '&units=metric';
        $data = file_get_contents($url);

        return $this->parser->parseData($data);
    }

}