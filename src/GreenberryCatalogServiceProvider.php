<?php

namespace Mcpuishor\GreenberryCatalog;

use Illuminate\Support\ServiceProvider;

class GreenberryCatalogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        
    }
}
