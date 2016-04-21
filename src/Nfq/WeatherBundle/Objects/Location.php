<?php

namespace Nfq\WeatherBundle\Objects;

class Location
{
    private $cityName;

    private $lat;

    private $lon;


    public function __construct(float $lat, float $lon)
    {
            $this->lat = $lat;
            $this->lon = $lon;
    }

    public function setCityName(string $cityName)
    {
        $this->cityName = $cityName;
    }

    public function getCityName():string
    {
        return $this->cityName;
    }

    public function getLatitude():float
    {
        return $this->lat;
    }

    public function getLongitude():float
    {
        return $this->lon;
    }

}