<?php

namespace App\Domain\City\Ports;

use Illuminate\Support\Collection;
use App\Models\City;

interface CityServicePort
{
    public function all(): Collection;
    public function findById(int $id): ?City;
    public function searchByName(string $name): Collection;
}
