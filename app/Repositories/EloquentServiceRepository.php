<?php

namespace App\Repositories;


use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

/**
 * Class EloquentCompanyRepository
 * @package App\Repositories
 */
class EloquentServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * EloquentServiceRepository constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $services = $this->service->with('place')->get();

        return empty($services) ? [] : $services->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $service = $this->service->with('place')->find($id);

        return empty($service) ? [] : $service->toArray();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->service->where('id', $id)->update($data);
    }

    /**
     * @param array $serviceData
     * @return Service
     */
    public function store(array $serviceData): Service
    {
        $service = $this->service->create($serviceData);

        return $this->service->with('place')->find($service->id);
    }

}