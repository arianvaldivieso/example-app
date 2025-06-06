<?php

namespace App\Domain\City\Services;

use App\Domain\City\Ports\FavoriteCityServicePort;
use App\Domain\City\Ports\FavoriteCityRepositoryPort;
use Illuminate\Support\Collection;

class FavoriteCityService implements FavoriteCityServicePort
{
    protected $favoriteCityRepository;

    public function __construct(FavoriteCityRepositoryPort $favoriteCityRepository)
    {
        $this->favoriteCityRepository = $favoriteCityRepository;
    }

    public function add(int $userId, int $cityId): void
    {
        $this->favoriteCityRepository->add($userId, $cityId);
    }

    public function remove(int $userId, int $cityId): void
    {
        $this->favoriteCityRepository->remove($userId, $cityId);
    }

    public function getByUser(int $userId): Collection
    {
        return $this->favoriteCityRepository->getByUser($userId);
    }

    public function isFavorite(int $userId, int $cityId): bool
    {
        return $this->favoriteCityRepository->isFavorite($userId, $cityId);
    }
}
