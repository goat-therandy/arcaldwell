<?php

namespace App\Repositories\Services;

use App\Models\Services\Location\Location as LocationModel;
use Illuminate\Support\Facades\Http;

class Location {

    public function findOrCreateLocation($city, $latitude, $longitude, $boundingbox = null, $country = null, $state = null){


        $location = LocationModel::where('city', $city)
                    ->where('latitude', $latitude)
                    ->where('longitude', $longitude)
                    ->first();

        if(!$location){
            $location = LocationModel::create([
                'city' => $city,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'boundingbox' => $boundingbox,
                'country' => $country,
                'state' => $state,
            ]);
        }

        return $location;

    }

    //converts location string to lat/long
	//consider moving this function to a service class if it can be reused elsewhere
	public function convertLocationToLatLong(string $location): array {

		// Initialize the coordinates array with default values
		// This will be used to store latitude, longitude, and bounding box coordinates
		// If the location is not found, these values will remain as defaults.
		// If the location is found, they will be updated with the actual coordinates.
		$coords_array = [
			'lat' => 0.0,
			'lon' => 0.0,
			'bounding_box' => [0.0, 0.0, 0.0, 0.0]
		];
		
		// For testing purposes, if the location is 'test', use a predefined location
		// Mainly for use in testing in artisan tinker
		if ($location == 'test'){
			$location = 'New York, NY';
			$response = Http::get('https://geocode.maps.co/search?q=' . urlencode($location) . '&apikey=' . config('integrations.maps_key'));
			$response_arr = $response->json();
            \Log::info($response_arr);
			$lat = $response_arr[0]['lat'] ?? 0.0;
			$long = $response_arr[0]['lon'] ?? 0.0;
			$boundingBox = $response_arr[0]['boundingbox'] ?? [0.0, 0.0, 0.0, 0.0];

			echo("\nLAT = $lat");
			echo("\nLONG = $long");
			echo("\nBounding Box = " . implode(', ', $boundingBox));
		}

		// Make an HTTP GET request to the geocoding API with the provided location
		// Response is expected to be in JSON format
		$response = Http::get('https://geocode.maps.co/search?q=' . urlencode($location) . '&apikey=' . config('integrations.maps_key'));

		// Check if the response is successful (HTTP status code 200)
		// If the response is successful, parse the JSON response to extract latitude and longitude
		// If the response contains 'lat' and 'lon', update the coordinates array with these values
		// If the response contains 'boundingbox', update the bounding box in the coordinates array
		if ($response->successful()) {

			$response_arr = $response->json();

			if (isset($response_arr[0]['lat']) && isset($response_arr[0]['lon'])) {
				$coords_array['lat'] = $response_arr[0]['lat'];
				$coords_array['lon'] = $response_arr[0]['lon'];
			}

			if (isset($response_arr[0]['boundingbox'])) {
				$coords_array['bounding_box'] = $response_arr[0]['boundingbox'];
			}

			//return the coordinates array with the updated latitude, longitude, and bounding box
			return $coords_array;
		} else {
			// If the response is not successful, return the default coordinates array
			// This indicates that the location could not be found or there was an error in the request
			return $coords_array;
		}

		//Shoud never reach here, but just in case
		return $coords_array;
	}


}