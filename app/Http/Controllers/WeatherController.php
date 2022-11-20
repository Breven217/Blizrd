<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    public function getCurrentWeather()
    {
        return file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat=" . 
        config('app.logan_lat') . "&lon=" . config('app.logan_lon') . "&appid=" . config('app.openweather_key') . "&units=imperial");
    }

    public function getForecast() 
    {
        return file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=" .
        config('app.logan_lat') . "&lon=" . config('app.logan_lon') . "&cnt=5&appid=" . config('app.openweather_key') . "&units=imperial");
    }
}
