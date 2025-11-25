<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Services\Weather\LocationController;
use App\Http\Controllers\Services\Weather\WeatherController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('weather', function () {
    return Inertia::render('Weather');
})->name('weather');

Route::get('weather/location/{location}', [LocationController::class, 'show'])->name('weather.location');

Route::get('weather/data/{location}', [WeatherController::class, 'show'])->name('weather.forecast');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
