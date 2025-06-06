<?php

namespace App\Domain\City\Ports;

use Illuminate\Support\Collection;

interface FavoriteCityServicePort
{
    public function add(int $userId, int $cityId): void;
    public function remove(int $userId, int $cityId): void;
    public function getByUser(int $userId): Collection;
    public function isFavorite(int $userId, int $cityId): bool;
}
