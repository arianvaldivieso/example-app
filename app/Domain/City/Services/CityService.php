<?php

namespace App\Domain\City\Services;

use App\Domain\City\Ports\CityServicePort;
use App\Domain\City\Ports\CityRepositoryPort;
use Illuminate\Support\Collection;
use App\Models\City;

class CityService implements CityServicePort
{
    protected $cityRepository;

    public function __construct(CityRepositoryPort $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function all(): Collection
    {
        return $this->cityRepository->all();
    }

    public function findById(int $id): ?City
    {
        return $this->cityRepository->findById($id);
    }

    public function searchByName(string $name): Collection
    {
        return $this->cityRepository->searchByName($name);
    }
}
