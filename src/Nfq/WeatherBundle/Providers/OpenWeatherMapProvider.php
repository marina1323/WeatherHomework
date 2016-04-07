<?php


namespace Nfq\WeatherBundle\Providers;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Parsers\OpenWeatherMapDataParser;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    private $parser;
    private $api_key;

    public function __construct(OpenWeatherMapDataParser $parser, $api_key)
    {
        $this->parser = $parser;
        $this->api_key = $api_key;
    }

    public function fetchCurrentWeather(Location $location):Weather
    {
        $url = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $location->getLatitude() .'&lon=' . $location->getLongitude(). '&appid=' . $this->api_key. '&units=metric';
        $data = file_get_contents($url);
        if(!$data)
        {
            throw new WeatherProviderException("Unable to get weather data");
        }

        return $this->parser->parseData($data);
    }

}