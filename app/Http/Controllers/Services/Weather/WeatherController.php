<?php

namespace App\Http\Controllers\Services\Weather;

use App\Http\Controllers\Controller;
use Models\Services\Weather\Weather as WeatherModel;
use App\Repositories\Services\{
    Weather as WeatherRepo,
    Location as LocationRepo
};
use Inertia\Inertia;

/**
 * This handles user preferences for the weather service.
 * It also handles the API for getting the weather data.
 */


class WeatherController extends Controller{

    protected $weather_repo;

    public function __construct(WeatherRepo $weather_repo){
        $this->weather_repo = $weather_repo;
    }

	public function show($location){

        $forecast = $this->weather_repo->fetchWeatherData($location);
        
        return Inertia::render('Weather', [
            'forecast' => $forecast
        ]);
        

    }

}