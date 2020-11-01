<?php
namespace Codium\CleanCode;

interface ForecastWeatherRepository 
{
    public function getCityId(string $city):string;
    public function getWeather(string $city):array;
   
}