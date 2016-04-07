<?php


namespace Nfq\WeatherBundle\Parsers;

use Nfq\WeatherBundle\Objects\Weather;


interface DataParserInterface
{
    public function parseData($jsonData):Weather;

}