<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.7
 * Time: 10.09
 */

namespace Nfq\WeatherBundle\Parsers;


use Nfq\WeatherBundle\Exceptions\WeatherProviderException;
use Nfq\WeatherBundle\Objects\Weather;

class OpenWeatherMapDataParser implements DataParserInterface
{

    public function parseData($jsonData):Weather
    {
        $data = json_decode($jsonData);
        if(!isset($data->main->temp))
        {
            throw new WeatherProviderException('Unable to get temperature');
        }
        $weather = new Weather(round($data->main->temp));
        return $weather;
    }
}