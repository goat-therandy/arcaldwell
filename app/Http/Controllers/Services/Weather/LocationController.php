<?php

namespace App\Http\Controllers\Services\Weather;

use App\Http\Controllers\Controller;
use App\Repositories\Services\Weather as WeatherRepository;
use Inertia\Inertia;

class LocationController extends Controller {

    public function show($location){
        /*
        \Log::info('Received location: ' . $location);

        $weatherRepo = new WeatherRepository();
        $lat_long = $weatherRepo->convertLocationToLatLong($location);

        \Log::info('Converted location ' . $location . ' to lat/long: ' . json_encode($lat_long));

        return $lat_long;
        */

        $weatherRepo = new WeatherRepository();
        $lat_long = $weatherRepo->convertLocationToLatLong($location);

        return Inertia::render('Weather', [
            'location' => $location,
            'lat_long' => $lat_long
        ]);

    }

}