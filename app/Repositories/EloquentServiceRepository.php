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
}