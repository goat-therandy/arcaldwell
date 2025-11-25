<?php

namespace App\Models\Services\WeatherController;

use App\Http\Controllers\Controller;
use Models\Services\Weather\Weather as WeatherModel;
use App\Repositories\Services\Weather\Weather as WeatherRepo;
use Inertia\Inertia;

/**
 * This handles user preferences for the weather service.
 * It also handles the API for getting the weather data.
 */


class WeatherController extends Controller{

	public function getWeatherData($latitude, $longitude){

        $weather_repo = new WeatherRepo();
        $weather_data = $weather_repo->fetchWeatherData($latitude, $longitude);
        

        /*
        return Inertia::render('Weather', [
            'weather_data' => $weather_data
        ]);
        */

    }

}