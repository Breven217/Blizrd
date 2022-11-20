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

        $listData = $listData->mapToGroups(function ($item) {
            return [
                date('m/d/Y', $item->dt) => $item['data']
            ];
        });

        // $listData = $listData->map(function ($item) {
        //     return [
        //         "day" => date('m/d/Y', $item->dt),
        //         "data" => [
        //             "time" => date('g A', $item->dt),
        //             "temp_min" => $item->main->temp_min,
        //             "temp_max" => $item->main->temp_max,
        //             "weather_code" => $item->weather[0]->id,
        //             "weather_description" => $item->weather[0]->description
        //             ]
        //     ];
        // });

        return $listData;
    }
}
