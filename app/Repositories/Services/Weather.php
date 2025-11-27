<?php 

namespace App\Repositories\Services;

use App\Models\Services\Weather\Weather as WeatherModel;
use Illuminate\Support\Facades\Http;
use App\Repositories\Services\Location as LocationRepository;

/**
 * Weather service repository for handling weather-related operations.
 * 
 */

class Weather {

	public function fetchWeatherData($location){

		$location_repo = new LocationRepository();
		$coords = $location_repo->convertLocationToLatLong($location);
		$latitude = $coords['lat'];
		$longitude = $coords['lon'];

		$latitude = $this->truncate($latitude, 4);
		$longitude = $this->truncate($longitude, 4);

		$url = "https://api.weather.gov/points/$latitude,$longitude";
		$response = Http::get("https://api.weather.gov/points/$latitude,$longitude");

		if($response->successful()){

			$weather_arr = $response->json();
			$forecast_url = $weather_arr['properties']['forecast'];
			$forecast_response = Http::get($forecast_url);
			
			if($forecast_response->successful()){

				$forecast = $forecast_response->json();
				$forecast_data = $forecast['properties']['periods'];
				

				return $forecast_data;
			} else {
				return null;
			}

			return $response->json();
		} else {
			return null;
		}

	}

	protected function truncate($val, $f = 0) {
    if (($p = strpos($val, '.')) !== false) {
        $val = floatval(substr($val, 0, $p + 1 + $f));
    }
    return $val;
}

}