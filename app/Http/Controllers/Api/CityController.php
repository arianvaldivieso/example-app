<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Http\Responses\ApiResponse;
use App\Enums\ApiResponseCode;
use App\Domain\City\Services\CityService;
use App\Domain\City\Services\RecentCitySearchService;
use App\Domain\City\Services\FavoriteCityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    protected $cityService;
    protected $recentSearchService;
    protected $favoriteCityService;

    public function __construct(CityService $cityService, RecentCitySearchService $recentSearchService, FavoriteCityService $favoriteCityService)
    {
        $this->cityService = $cityService;
        $this->recentSearchService = $recentSearchService;
        $this->favoriteCityService = $favoriteCityService;
    }

    public function index(Request $request)
    {
        $name = $request->query('name');
        if (!is_null($name) && $name !== '') {
            $cities = $this->cityService->searchByName($name);
            $user = Auth::user();
            foreach ($cities as $city) {
                $this->recentSearchService->store($user->id, $city->id);
            }
            return new ApiResponse($cities, 'Cities search result.', ApiResponseCode::SUCCESS);
        }
        $cities = $this->cityService->all();
        return new ApiResponse($cities, 'Cities list.', ApiResponseCode::SUCCESS);
    }

    public function show($id)
    {
        $city = $this->cityService->findById((int) $id);
        if (!$city) {
            return new ApiResponse(null, 'City not found.', ApiResponseCode::NOT_FOUND);
        }
        return new ApiResponse($city, 'City found.', ApiResponseCode::SUCCESS);
    }

    public function recentSearches()
    {
        $user = Auth::user();
        $searches = $this->recentSearchService->getByUser($user->id);
        return new ApiResponse($searches, 'Recent city searches.', ApiResponseCode::SUCCESS);
    }

    public function addFavorite(Request $request)
    {
        $request->validate(['city_id' => 'required|integer|exists:cities,id']);
        $user = Auth::user();
        $this->favoriteCityService->add($user->id, $request->city_id);
        return new ApiResponse(null, 'City added to favorites.', ApiResponseCode::SUCCESS);
    }

    public function removeFavorite(Request $request)
    {
        $request->validate(['city_id' => 'required|integer|exists:cities,id']);
        $user = Auth::user();
        $this->favoriteCityService->remove($user->id, $request->city_id);
        return new ApiResponse(null, 'City removed from favorites.', ApiResponseCode::SUCCESS);
    }

    public function myFavorites()
    {
        $user = Auth::user();
        $favorites = $this->favoriteCityService->getByUser($user->id);
        return new ApiResponse($favorites, 'Favorite cities.', ApiResponseCode::SUCCESS);
    }
}
