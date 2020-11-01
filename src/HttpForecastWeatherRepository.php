<?php
namespace Codium\CleanCode;

use GuzzleHttp\Client;

final class HttpForecastWeatherRepository implements ForecastWeatherRepository
{
    private const WEATHERURL="https://www.metaweather.com/api/location/";
    private const CITYURL="https://www.metaweather.com/api/location/search/?query=";

    public function getCityId(string $city):string
    {
        $client = new Client();
        return json_decode($client->get(self::CITYURL.$city)->getBody()->getContents(),
        true)[0]['woeid'];
       
    }
    public function getWeather(string $city):array
    {
        $client = new Client();
        return json_decode($client->get(self::WEATHERURL.$city)->getBody()->getContents(),
        true)['consolidated_weather'];

    }
 
}