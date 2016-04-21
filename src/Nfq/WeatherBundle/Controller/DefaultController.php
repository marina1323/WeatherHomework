<?php

namespace Nfq\WeatherBundle\Controller;

use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;
use Nfq\WeatherBundle\Parsers\OpenWeatherMapDataParser;
use Nfq\WeatherBundle\Parsers\YahooWeatherDataParser;
use Nfq\WeatherBundle\Providers\CachedProvider;
use Nfq\WeatherBundle\Providers\DelegatingProvider;
use Nfq\WeatherBundle\Providers\OpenWeatherMapProvider;
use Nfq\WeatherBundle\Providers\YahooWeatherProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $location = new Location(35,139);
        $location->setCityName('Vilnius');
        $weatherProvider = $this->get('nfq_weather.provider');
        $weather = $weatherProvider->fetchCurrentWeather($location);
        return $this->render('NfqWeatherBundle:Default:index.html.twig', array('weather' => $weather->getTemperature()));
    }
}
