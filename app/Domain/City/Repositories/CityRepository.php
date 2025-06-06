<?php

namespace App\Domain\City\Repositories;

use App\Domain\City\Ports\CityRepositoryPort;
use App\Models\City;
use Illuminate\Support\Collection;

class CityRepository implements CityRepositoryPort
{
    public function all(): Collection
    {
        return City::all(['id', 'name', 'latitude', 'longitude']);
    }

    public function findById(int $id): ?City
    {
        return City::find($id);
    }

    public function searchByName(string $name): Collection
    {
        return City::where('name', 'like', "%$name%")
            ->get(['id', 'name', 'latitude', 'longitude']);
    }
}
