<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ToolTaxCalServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Service\ToolTaxCalServiceInterface', 'App\Service\ToolTaxCalService');

    }
}
