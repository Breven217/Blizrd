<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeatherController;
use App\Models\User;
use App\Notifications\ForecastText;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class WeatherAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:WeatherAlert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the forecast for the following day and sends an alert to all 
    users who receive one if snow is on the forecast';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $weatherController = new WeatherController();

        $forecastTomorrow = $weatherController->getForecast()[1]['data'];

        $snowCasts = $forecastTomorrow->whereIn('weather_code',[800,600,601,602,611,612,613,615,616,620,621,622]);

        // if (!filled($snowCasts)){
        //     return Command::SUCCESS;
        // }

        $message = "Snow is on tomorrow's forecast: ";

        foreach ($snowCasts as $cast) {
            $message .= "\n Time: " . $cast['time'] . " : " . $cast['weather_description'];
        }

        $users = User::where('receives_alerts',true)->get();
        
        Notification::send($users, new ForecastText($message));
        return Command::SUCCESS;
    }

}
