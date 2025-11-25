<?php 

namespace App\Repositories\Services;

use App\Models\Services\Weather\Weather as WeatherModel;
use Illuminate\Support\Facades\Http;

/**
 * Weather service repository for handling weather-related operations.
 * 
 */

class Weather {

	public function fetchWeatherData($latitude, $longitude){

		$latitude = $this->truncate($latitude, 4);
		$longitude = $this->truncate($longitude, 4);

		\Log::info("Fetching weather data for lat: $latitude, lon: $longitude");

		$response = Http::get("https://api.weather.gov/points/$latitude,$longitude");

		if($response->successful()){

			$weather_arr = $response->json();
			\Log::info('Weather API response: ', $weather_arr);

			return $response->json();
		} else {
			\Log::info('Weather API request failed: ' . $response->status());
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