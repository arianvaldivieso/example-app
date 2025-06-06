<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\WeatherController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/me', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::prefix('users')->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

Route::prefix('weather')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [WeatherController::class, 'getWeather']);
});

Route::prefix('cities')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [CityController::class, 'index']);
    Route::get('/recent/searches', [CityController::class, 'recentSearches']);
    Route::get('/favorites', [CityController::class, 'myFavorites']);
    Route::post('/favorites', [CityController::class, 'addFavorite']);
});
