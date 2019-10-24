<?php

namespace App\Repositories;


use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

/**
 * Class EloquentCompanyRepository
 * @package App\Repositories
 */
class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var Company
     */
    protected $company;

    /**
     * EloquentCompanyRepository constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
}