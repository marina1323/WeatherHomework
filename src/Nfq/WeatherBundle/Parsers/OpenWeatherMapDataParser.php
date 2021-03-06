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

    public function parseData(string $jsonData):Weather
    {
        $data = json_decode($jsonData);

        if (!$data)
        {
            throw new WeatherProviderException('Unable to get json data');
        }

        if (isset($data->cod) && $data->cod !== 200)
        {
            throw new WeatherProviderException('The request was unsuccessful');
        }

        if(!isset($data->main->temp))
        {
            throw new WeatherProviderException('Unable to get temperature');
        }

         return new Weather(round($data->main->temp));
    }
}