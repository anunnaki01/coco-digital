<?php

namespace App\Repositories\Interfaces;

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
}