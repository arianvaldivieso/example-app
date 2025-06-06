<?php

namespace App\Domain\City\Repositories;

use App\Domain\City\Ports\RecentCitySearchRepositoryPort;
use App\Models\RecentCitySearch;
use Illuminate\Support\Collection;

class RecentCitySearchRepository implements RecentCitySearchRepositoryPort
{
    public function store(int $userId, int $cityId): void
    {
        RecentCitySearch::create([
            'user_id' => $userId,
            'city_id' => $cityId,
            'searched_at' => now(),
        ]);
    }

    public function getByUser(int $userId): Collection
    {
        return RecentCitySearch::where('user_id', $userId)
            ->orderByDesc('searched_at')
            ->with('city')
            ->get();
    }
}
