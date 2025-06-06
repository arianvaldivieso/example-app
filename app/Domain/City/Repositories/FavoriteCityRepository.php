<?php

namespace App\Domain\City\Repositories;

use App\Domain\City\Ports\FavoriteCityRepositoryPort;
use App\Models\FavoriteCity;
use Illuminate\Support\Collection;

class FavoriteCityRepository implements FavoriteCityRepositoryPort
{
    public function add(int $userId, int $cityId): void
    {
        FavoriteCity::firstOrCreate([
            'user_id' => $userId,
            'city_id' => $cityId,
        ]);
    }

    public function remove(int $userId, int $cityId): void
    {
        FavoriteCity::where('user_id', $userId)
            ->where('city_id', $cityId)
            ->delete();
    }

    public function getByUser(int $userId): Collection
    {
        return FavoriteCity::where('user_id', $userId)
            ->with('city')
            ->get();
    }

    public function isFavorite(int $userId, int $cityId): bool
    {
        return FavoriteCity::where('user_id', $userId)
            ->where('city_id', $cityId)
            ->exists();
    }
}
