<?php

namespace Soved\Laravel\Sendcloud;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Soved\Laravel\Sendcloud\Contracts\SendcloudContract;
use Illuminate\Foundation\Application as LaravelApplication;

class SendcloudServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->offerPublishing();

        $this->app->singleton(SendcloudContract::class, Sendcloud::class);
    }

    /**
     * Setup the configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $source = realpath($raw = __DIR__.'/../config/sendcloud.php') ?: $raw;

        if ($this->app instanceof LumenApplication) {
            $this->app->configure('sendcloud');
        }

        $this->mergeConfigFrom($source, 'sendcloud');
    }

    /**
     * Setup the resource publishing groups.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sendcloud.php' => config_path('sendcloud.php'),
            ], 'sendcloud-config');
        }
    }
}
