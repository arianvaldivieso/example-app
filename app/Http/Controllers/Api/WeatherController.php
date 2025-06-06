<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Enums\ApiResponseCode;
use App\Domain\Weather\Services\WeatherService;
use App\Http\Requests\WeatherRequest;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(WeatherRequest $request)
    {
        $lat = (float) $request->input('lat');
        $lon = (float) $request->input('lon');
        $weather = $this->weatherService->getWeatherData($lat, $lon);
        if (!$weather) {
            return new ApiResponse(null, 'No se pudo obtener el clima.', ApiResponseCode::BAD_REQUEST);
        }
        return new ApiResponse($weather, 'Consulta de clima exitosa.', ApiResponseCode::SUCCESS);
    }
}
