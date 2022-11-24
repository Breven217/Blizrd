<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    /**
     * gets the current weather data from openweathermap api and returns it
     *
     * @return string
     */
    public function getCurrentWeather()
    {
        return file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat=" . 
        config('app.logan_lat') . "&lon=" . config('app.logan_lon') . "&appid=" . config('app.openweather_key') . "&units=imperial");
    }

    /**
     * gets the forecast data from the openweathermap api then maps and returns it
     *
     * @return \Illuminate\Support\Collection
     */
    public function getForecast() 
    {
        $rawData = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?lat=" .
        config('app.logan_lat') . "&lon=" . config('app.logan_lon') . "&appid=" . config('app.openweather_key') . "&units=imperial");
        
        $rawData = json_decode($rawData);
        $listData = collect($rawData->list);

        $listData->each(function ($item) {
            $item->day = date('m/d/Y', $item->dt);
        });

        $listData = $listData->groupBy('day')->values();

        $listData = $listData->map(function ($item) {
            return [
                "day" => $item->first()->day,
                "temp_min" => $item->pluck('main.temp_min')->min(),
                "temp_max" => $item->pluck('main.temp_max')->max(),
                "data" => $item->map(function ($i) {
                    return[
                    "time" => date('g A', $i->dt),
                    "weather_code" => $i->weather[0]->id,
                    "weather_description" => $i->weather[0]->description
                    ];
                })
            ];
        });

        return $listData;
    }
}
