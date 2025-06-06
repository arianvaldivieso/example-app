<?php

namespace App\Domain\Weather\Repositories;

use App\Domain\Weather\Ports\WeatherRepositoryPort;
use Illuminate\Support\Facades\Http;

class WeatherRepository implements WeatherRepositoryPort
{
    public function getWeather(float $lat, float $lon): ?array
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric&lang=es";
        $response = Http::get($url);
        if (!$response->ok()) {
            return null;
        }
        return $response->json();
    }
}
