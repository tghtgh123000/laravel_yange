<?php

namespace App\Providers;

use App\Contracts\SmsContract;
use App\Services\Sms\SmsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    //是否延迟加载
//    protected $defer = true;
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
        $this->app->singleton(SmsContract::class , function (){
            Log::info('Provider Loaded: SmsServiceProvider');
            return new SmsService(config('sms'));
        });
    }
}
