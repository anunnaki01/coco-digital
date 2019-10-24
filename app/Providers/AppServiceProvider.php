<?php

namespace App\Providers;

use App\Repositories\EloquentCompanyRepository;
use App\Repositories\EloquentPlaceRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $classes = [
        PlaceRepositoryInterface::class => EloquentPlaceRepository::class,
        CompanyRepositoryInterface::class => EloquentCompanyRepository::class,
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
