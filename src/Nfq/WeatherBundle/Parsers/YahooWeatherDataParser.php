<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.9
 * Time: 14.01
 */

namespace Nfq\WeatherBundle\Parsers;


use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Exceptions\WeatherProviderException;

class YahooWeatherDataParser implements DataParserInterface
{

    public function parseData(string $jsonData):Weather
    {
        $data = json_decode($jsonData);

        if (!$data)
        {
            throw new WeatherProviderException('Unable to get json data');
        }

        if(!isset($data->query->results->channel->item->condition->temp))
        {
            throw new WeatherProviderException('Unable to get temperature');
        }

        $weather = new Weather(round($data->query->results->channel->item->condition->temp));

        return $weather;
    }
}