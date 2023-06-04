<?php

namespace Btx\Query;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as IlluminateApplication;

class BtxQueryServiceProvider extends ServiceProvider
{
    protected $provider;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->provider = $this->getProvider();
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (method_exists($this->provider, 'boot')) {
            return $this->provider->boot();
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        return $this->provider->register();
    }

    /**
     * Return ServiceProvider according to Laravel version
     *
     * @return \Intervention\Image\Provider\ProviderInterface
     */
    private function getProvider()
    {
        if ($this->app instanceof LumenApplication) {
            $provider = BtxQueryServiceProviderLumen::class;
        } else {
            $provider = BtxQueryServiceProviderLaravel::class;
        }

        return new $provider($this->app);
    }
}
