<?php

namespace Btx\Common;

use Illuminate\Support\ServiceProvider;

class BtxCommonServiceProviderLumen extends ServiceProvider
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
            __DIR__.'/../../config/btx.php' => config_path('btx.php'),
        ], 'btx');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $this->mergeConfigFrom( __DIR__.'/../../config/btx.php', 'btx');

        $app->alias('BtxCommon', 'Btx\Common');
    }
}
