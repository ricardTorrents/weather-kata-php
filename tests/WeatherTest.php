<?php

namespace Tests\Codium\CleanCode;

use Codium\CleanCode\ForecastWeatherController;
use Codium\CleanCode\HttpForecastWeatherRepository;
use Codium\CleanCode\ForecastWeather;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    // https://www.metaweather.com/api/location/766273/
    /** @test */
    public function find_the_weather_of_today()
    {
        $forecastWeatherRepository = new HttpForecastWeatherRepository();
      
        $forecastWeather =  new ForecastWeather($forecastWeatherRepository);
       
        $forecast = new ForecastWeatherController($forecastWeather);
        $city = "Madrid";

        $prediction = $forecast->predictWeather($city);

        echo "Today: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_weather_of_any_day()
    {
        $forecastWeatherRepository = new HttpForecastWeatherRepository();
        $forecastWeather =  new ForecastWeather($forecastWeatherRepository);
        $forecast = new ForecastWeatherController($forecastWeather);
        $city = "Madrid";

        $prediction = $forecast->predictWeather($city, new \DateTime('+2 days'));
       
        echo "Day after tomorrow: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_wind_of_any_day()
    {
        $forecastWeatherRepository = new HttpForecastWeatherRepository();
        $forecastWeather =  new ForecastWeather($forecastWeatherRepository);
        $forecast = new ForecastWeatherController($forecastWeather);
        $city = "Madrid";

        $prediction = $forecast->predictWind($city, null);
        echo "Wind: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function change_the_city_to_woeid()
    {
        $forecastWeatherRepository = new HttpForecastWeatherRepository();
        $forecastWeather =  new ForecastWeather($forecastWeatherRepository);
        $forecast = new ForecastWeatherController($forecastWeather);
        $city = "Madrid";
        $forecast->predictWind($city, null);
        $this->assertEquals("766273", $city);
    }

    /** @test */
    public function there_is_no_prediction_for_more_than_5_days()
    {
        $forecastWeatherRepository = new HttpForecastWeatherRepository();
        $forecastWeather =  new ForecastWeather($forecastWeatherRepository);
        $forecast = new ForecastWeatherController($forecastWeather);
        $city = "Madrid";

        $prediction = $forecast->predictWeather($city, new \DateTime('+6 days'));

        $this->assertEquals("", $prediction);
    }
}