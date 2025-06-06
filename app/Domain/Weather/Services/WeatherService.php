<?php

namespace App\Domain\Weather\Services;

use App\Domain\Weather\Ports\WeatherServicePort;
use App\Domain\Weather\Ports\WeatherRepositoryPort;

class WeatherService implements WeatherServicePort
{
    protected $weatherRepository;

    public function __construct(WeatherRepositoryPort $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function getWeatherData(float $lat, float $lon): ?array
    {
        $data = $this->weatherRepository->getWeather($lat, $lon);
        if (!$data) {
            return null;
        }
        return [
            'temperature' => $data['main']['temp'] ?? null,
            'weather' => $data['weather'][0]['description'] ?? null,
            'wind' => $data['wind']['speed'] ?? null,
            'humidity' => $data['main']['humidity'] ?? null,
            'local_time' => isset($data['timezone']) ? now()->setTimezone($data['timezone']/3600)->toTimeString() : null,
        ];
    }
}
