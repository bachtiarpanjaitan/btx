<?php

namespace Btx\Common;

use Illuminate\Support\ServiceProvider;

class BtxCommonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // include __DIR__.'/Constants/Operator.php';
        $this->publishes([
            __DIR__.'/config/btx.php' => config_path('btx.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/btx.php', 'btx');
    }
}