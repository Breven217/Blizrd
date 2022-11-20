<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getCurrentWeather(){
        return file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat=" . 
        config('app.logan_lat') . "&lon=" . config('app.logan_lon') . "&appid=" . config('app.openweather_key') . "&units=imperial");

        //return file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=41.68417&lon=-111.67957&appid=54a6d10f3bffb5d3e5e67b9fa58a63a6");
    }

    public function getWeatherAlerts() {
        return file_get_contents("https://api.weather.gov/alerts/active?area=AK");//change me to utah
    }
}
