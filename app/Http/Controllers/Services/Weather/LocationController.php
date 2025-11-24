<?php

namespace App\Http\Controllers\Services\Weather;

use App\Http\Controllers\Controller;
use App\Repositories\Services\Location as LocationRepository;
use Inertia\Inertia;

class LocationController extends Controller {

    public function show($location){

        $location_repo = new LocationRepository();
        $lat_long = $location_repo->convertLocationToLatLong($location);

        return Inertia::render('Weather', [
            'location' => $location,
            'lat_long' => $lat_long
        ]);

    }

}