<?php

namespace Codium\CleanCode;



class ForecastWeatherController
{
    private const TIMELASTPREDICTION="+6 days 00:00:00";
    private $forecast_weather;

    public function __construct(ForecastWeather $a_forecast_weather)
    {
        $this->$forecast_weather = $a_forecast_weather; 
    }

    private function isValidDate(\DateTime &$datetime=null):bool
    {
        if (!$datetime) {
            $datetime = new \DateTime();
        }
        return  $datetime < new \DateTime(self::TIMELASTPREDICTION);
    }
    public function predictWind(string &$city, \DateTime $datetime = null):string
    {
        // If there are predictions
        if (!$this->isValidDate($datetime)) {
            return '';
        }
        $results=$this->$forecast_weather->getWeather($city,$datetime);
        return $results['wind_speed'];
    }
    

    public function predictWeather(string &$city, \DateTime $datetime = null): string
    {
        if (!$this->isValidDate($datetime)) {
            return '';
        }
        $results=$this->$forecast_weather->getWeather($city,$datetime);
        return $results['weather_state_name'];
    }

  
}