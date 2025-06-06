<?php

namespace App\Domain\City\Ports;

use Illuminate\Support\Collection;

interface RecentCitySearchRepositoryPort
{
    public function store(int $userId, int $cityId): void;
    public function getByUser(int $userId): Collection;
}
