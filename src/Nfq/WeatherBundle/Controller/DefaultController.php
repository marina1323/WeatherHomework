<?php

namespace Nfq\WeatherBundle\Controller;

use Nfq\WeatherBundle\Objects\Location;
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
        $weatherService = $this->get('nfq.weather');
        $weather = $weatherService->fetchCurrentWeather($location);
        return $this->render('NfqWeatherBundle:Default:index.html.twig', array('weather' => $weather));
    }
}
