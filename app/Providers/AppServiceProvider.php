<?php

namespace App\Providers;

use App\Repositories\EloquentCompanyRepository;
use App\Repositories\EloquentPlaceRepository;
use App\Repositories\EloquentServiceRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $classes = [
        PlaceRepositoryInterface::class => EloquentPlaceRepository::class,
        CompanyRepositoryInterface::class => EloquentCompanyRepository::class,
        ServiceRepositoryInterface::class => EloquentServiceRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, function () use ($implementation) {
                return app($implementation);
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
