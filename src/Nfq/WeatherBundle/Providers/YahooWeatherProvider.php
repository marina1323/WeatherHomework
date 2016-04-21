<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.9
 * Time: 13.55
 */

namespace Nfq\WeatherBundle\Providers;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Parsers\YahooWeatherDataParser;

class YahooWeatherProvider implements WeatherProviderInterface
{

    private $parser;


    public function __construct(YahooWeatherDataParser $parser)
    {
        $this->parser = $parser;
    }

    public function fetchCurrentWeather(Location $location):Weather
    {
        $data = '';
        $baseUrl = 'https://query.yahooapis.com/v1/public/yql?format=json&q=';
        $query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="%s") and u="c"';
        $url = $baseUrl.urlencode(sprintf($query, $location->getCityName()));

        try
        {
            $data = file_get_contents($url);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }

        return $this->parser->parseData($data);
    }
}