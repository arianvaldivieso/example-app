<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;
use App\Domain\User\Ports\UserServicePort;
use App\Domain\User\Ports\UserRepositoryPort;
use App\Domain\User\Services\UserService;
use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Ports\AuthServicePort;
use App\Domain\User\Services\AuthService;
use App\Domain\Weather\Ports\WeatherRepositoryPort;
use App\Domain\Weather\Repositories\WeatherRepository;
use App\Domain\Weather\Ports\WeatherServicePort;
use App\Domain\Weather\Services\WeatherService;
use App\Domain\City\Ports\CityRepositoryPort;
use App\Domain\City\Repositories\CityRepository;
use App\Domain\City\Ports\CityServicePort;
use App\Domain\City\Services\CityService;
use App\Domain\City\Ports\RecentCitySearchRepositoryPort;
use App\Domain\City\Repositories\RecentCitySearchRepository;
use App\Domain\City\Ports\RecentCitySearchServicePort;
use App\Domain\City\Services\RecentCitySearchService;
use App\Domain\City\Ports\FavoriteCityRepositoryPort;
use App\Domain\City\Repositories\FavoriteCityRepository;
use App\Domain\City\Ports\FavoriteCityServicePort;
use App\Domain\City\Services\FavoriteCityService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServicePort::class, UserService::class);
        $this->app->bind(UserRepositoryPort::class, UserRepository::class);
        $this->app->bind(AuthServicePort::class, AuthService::class);
        $this->app->bind(WeatherRepositoryPort::class, WeatherRepository::class);
        $this->app->bind(WeatherServicePort::class, WeatherService::class);
        $this->app->bind(CityRepositoryPort::class, CityRepository::class);
        $this->app->bind(CityServicePort::class, CityService::class);
        $this->app->bind(RecentCitySearchRepositoryPort::class, RecentCitySearchRepository::class);
        $this->app->bind(RecentCitySearchServicePort::class, RecentCitySearchService::class);
        $this->app->bind(FavoriteCityRepositoryPort::class, FavoriteCityRepository::class);
        $this->app->bind(FavoriteCityServicePort::class, FavoriteCityService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
