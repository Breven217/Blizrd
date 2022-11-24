<?php

namespace App\Console\Commands;

use App\Http\Controllers\WeatherController;
use App\Models\User;
use App\Notifications\ForecastText;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class WeatherText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:WeatherText';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the forecast for the following day and sends an alert to all 
    users who receive one';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $weatherController = new WeatherController();

        $forecastTomorrow = $weatherController->getForecast()[1]['data'];

        $message = "Tomorrow's forecast: ";

        foreach ($forecastTomorrow as $cast) {
            $message .= "\n Time: " . $cast['time'] . " : " . $cast['weather_description'];
        }

        $users = User::where('receives_alerts',true)->get();
        
        echo("texts sent successfully with message: " . $message ."\n To the following users: \n" . $users);

        Notification::send($users, new ForecastText($message));
        return Command::SUCCESS;
    }

}
