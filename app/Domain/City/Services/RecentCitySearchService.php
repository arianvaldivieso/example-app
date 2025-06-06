<?php

namespace App\Domain\City\Services;

use App\Domain\City\Ports\RecentCitySearchServicePort;
use App\Domain\City\Ports\RecentCitySearchRepositoryPort;
use Illuminate\Support\Collection;

class RecentCitySearchService implements RecentCitySearchServicePort
{
    protected $recentSearchRepository;

    public function __construct(RecentCitySearchRepositoryPort $recentSearchRepository)
    {
        $this->recentSearchRepository = $recentSearchRepository;
    }

    public function store(int $userId, int $cityId): void
    {
        $this->recentSearchRepository->store($userId, $cityId);
    }

    public function getByUser(int $userId): Collection
    {
        return $this->recentSearchRepository->getByUser($userId);
    }
}
