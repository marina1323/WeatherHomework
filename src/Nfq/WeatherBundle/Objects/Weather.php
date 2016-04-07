<?php

namespace Nfq\WeatherBundle\Objects;

class Weather
{
    private $temperature;


    public function __construct($temperature)
    {
        $this->temperature = $temperature;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function __toString()
    {
        return strval($this->temperature);
    }



}