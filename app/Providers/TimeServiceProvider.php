<?php

namespace App\Providers;

use App\Services\TimeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class TimeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(TimeService::class , function(){
            Log::info('Provider Loaded: TimeServiceProvider');
            return new TimeService();
        });
    }
}
