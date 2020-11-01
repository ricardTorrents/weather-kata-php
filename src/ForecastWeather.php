<?php
namespace Codium\CleanCode;



class ForecastWeather
{
    private $weather_repository;
    public function __construct(ForecastWeatherRepository $a_forecast_weather_repository)
    {
        $this->$weather_repository = $a_forecast_weather_repository;
    }

    public function getWeather(string &$city, \DateTime $datetime):array
    {
        
        $city=$this->$weather_repository->getCityId($city);
        $results=$this->$weather_repository->getWeather($city);
        foreach ($results as $result) {
            if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
                    return $result;
            }
        }
    }
  

}