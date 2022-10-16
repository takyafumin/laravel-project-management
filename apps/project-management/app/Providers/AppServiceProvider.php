<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Project\Application\Queries\ProjectSearchQueryInterface;
use Project\Infra\Queries\ProjectSearchQuery;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        ProjectSearchQueryInterface::class => ProjectSearchQuery::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
