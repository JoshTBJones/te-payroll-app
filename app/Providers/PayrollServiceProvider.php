<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PayrollService;

class PayrollServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Bind PayrollService as a singleton
        $this->app->singleton(PayrollService::class, function ($app) {
            return new PayrollService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
