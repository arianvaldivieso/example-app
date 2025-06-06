<?php

namespace App\Domain\Weather\Ports;

interface WeatherRepositoryPort
{
    public function getWeather(float $lat, float $lon): ?array;
}
