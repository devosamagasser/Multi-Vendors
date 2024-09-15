<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\Web\CartInterface',
            'App\Repositories\Web\CartRepository',
        );


        $this->app->bind(
            'App\Interfaces\Dashboard\UsersInterface',
            'App\Repositories\Dashboard\UsersRepository',
        );


        $this->app->bind(
            'App\Interfaces\Dashboard\ProductsInterface',
            'App\Repositories\Dashboard\ProductsRepository',
        );

        $this->app->bind(
            'App\Interfaces\Dashboard\CategoriesInterface',
            'App\Repositories\Dashboard\CategoriesRepository',
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }




}
