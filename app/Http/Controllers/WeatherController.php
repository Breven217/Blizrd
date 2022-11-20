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
                "data" => $item->map(function ($i) {
                    return[
                    "time" => date('g A', $i->dt),
                    "temp_min" => $i->main->temp_min,
                    "temp_max" => $i->main->temp_max,
                    "weather_code" => $i->weather[0]->id,
                    "weather_description" => $i->weather[0]->description
                    ];
                })
            ];
        });

        return $listData;
    }
}
