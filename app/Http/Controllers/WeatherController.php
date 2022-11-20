<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getCurrentWeather(){
        return file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat=" . 
        config('logan_lat') . "&lon=" . config('logan_lon') . "&appid=" . config('openweather_key'));

        //return file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=41.68417&lon=-111.67957&appid=54a6d10f3bffb5d3e5e67b9fa58a63a6");
    }
}
