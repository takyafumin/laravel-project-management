<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Project\Application\Queries\ProjectSearchQueryInterface;
use Project\Domain\Repositories\ProjectRepositoryInterface;
use Project\Infra\Queries\ProjectSearchQuery;
use Project\Infra\Repositories\ProjectRepository;
use Support\Application\Queries\UserListQueryInterface;
use Support\Infra\Queries\UserListQuery;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserListQueryInterface::class => UserListQuery::class,
        ProjectSearchQueryInterface::class => ProjectSearchQuery::class,
        ProjectRepositoryInterface::class  => ProjectRepository::class,
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
