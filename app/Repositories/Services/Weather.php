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

		/**
		 * Each entry needs an id to pass eslinter tests.
		 * So we will create an id based on the weather.gov id + a counter for each period
		 * to make the ids unique.
		 */
		$id = "";
		$period_counter = 0;

		$latitude = $this->truncate($latitude, 4);
		$longitude = $this->truncate($longitude, 4);

		$response = Http::get("https://api.weather.gov/points/$latitude,$longitude");

		if($response->successful()){

			$weather_arr = $response->json();
			$forecast_url = $weather_arr['properties']['forecast'];
			$id = $weather_arr['id'];
			$forecast_response = Http::get($forecast_url);
			
			if($forecast_response->successful()){

				$forecast = $forecast_response->json();
				$forecast_data = $forecast['properties']['periods'];
				
				foreach($forecast_data as $period){
					$period['id'] = $id . "-" . $period_counter;
					$period_counter++;
				}
				

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



