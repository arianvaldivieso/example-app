<?php

namespace App\Domain\Weather\Ports;

interface WeatherServicePort
{
    public function getWeatherData(float $lat, float $lon): ?array;
}
