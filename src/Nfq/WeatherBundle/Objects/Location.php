<?php

namespace Nfq\WeatherBundle\Objects;

class Location
{
    private $lat;

    private $lon;


    public function __construct($lat, $lon)
    {
        if(!is_numeric($lat)|| !is_numeric($lon))
        {
            throw new \Exception('Latitude and longitude must be numeric: '.$lat." ".$lon);
        }

            $this->lat = $lat;
            $this->lon = $lon;

    }

    public function getLatitude()
    {
        return $this->lat;
    }

    public function getLongitude()
    {
        return $this->lon;
    }

}