<?php

namespace App\Repositories\Interfaces;

use App\Models\Service;

/**
 * Interface ServiceRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface ServiceRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param array $serviceData
     * @return Service
     */
    public function store(array $serviceData): Service;
}