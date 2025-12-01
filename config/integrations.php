<?php

// This file is used to configure integrations for the application.
// mainly just stores API keys

return [

	//not currently used because it costs money
	'google_maps_key' => env('GOOGLE_MAPS_API_KEY', false),
	'maps_key' => env('MAPS_CO_API_KEY', false),
	'gemini_key' => env('GEMINI_API_KEY', false),

];