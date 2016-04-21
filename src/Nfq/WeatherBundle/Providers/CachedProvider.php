<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.4.9
 * Time: 13.53
 */

namespace Nfq\WeatherBundle\Providers;


use Nfq\WeatherBundle\Objects\Location;
use Nfq\WeatherBundle\Objects\Weather;

class CachedProvider implements WeatherProviderInterface
{

    private $cacheFile;
    private $provider;
    private  $ttl;

    public function __construct(WeatherProviderInterface $provider,int $ttl)
    {
        $this->provider = $provider;
        $this->ttl = $ttl;
    }

    public function fetchCurrentWeather(Location $location):Weather
    {
        if(!$this->cacheExpired())
        {
              if($this->getDataFromCache($location)!==null)
              {
                  return $this->getDataFromCache($location);
              }
              else
              {
                  return $this->getDataFromProvider($location,false);
              }
        }

        return $this->getDataFromProvider($location,true);
    }

    private function cacheExpired():bool
    {
        if (file_exists($this->cacheFile))
        {
            if ((time() - $this->ttl) > filemtime($this->cacheFile))
            {
                return true;
            }
        }

        return false;
    }

    public function saveDataToCache(Location $location, Weather $weather, bool $ttlExpired)
    {
        $locationCity = $location->getCityName();
        $locationLat = $location->getLatitude();
        $locationLon = $location->getLongitude();
        $temperature = $weather->getTemperature();
        $newData = [$locationCity,$locationLat,$locationLon,$temperature];

        if (file_exists($this->cacheFile))
        {
            if ($ttlExpired)
            {
                file_put_contents($this->cacheFile, implode("\r\n", $newData));
            }
            else
            {
                $oldData = file($this->cacheFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $data = array_merge($oldData, $newData);
                file_put_contents($this->cacheFile, implode("\r\n", $data));
            }
        }

    }

    private function getDataFromProvider(Location $location, bool $ttlExpired):Weather
    {
        $weather = $this->provider->fetchCurrentWeather($location);
        $this->saveDataToCache($location,$weather,$ttlExpired);
        return $weather;
    }

    private function getDataFromCache(Location $location)
    {
        if (file_exists($this->cacheFile))
        {
            $data = file($this->cacheFile);
            foreach (array_chunk($data, 5) as $chunk)
            {
                if ($chunk[1] == $location->getCityName() && $chunk[2] == $location->getLatitude() && $chunk[3] == $location->getLongitude())
                {
                    return new Weather($chunk[4]);
                }
            }
        }

        return null;
    }

    public function  getFile(string $file)
    {
        $this->cacheFile = $file;

    }

}