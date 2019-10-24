<?php

namespace App\Repositories\Interfaces;

/**
 * Interface CompanyRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface CompanyRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array;
}