<?php

namespace Xolens\PgLaratraining;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Xolens\PgLarautil\PgLarautilServiceProvider;

class PgLaratrainingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->register(PgLarautilServiceProvider::class);

        $this->publishes([
            __DIR__.'/../../config/xolens-pglaratraining.php' => config_path('xolens-pglaratraining.php'),
        ]);
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/xolens-pglaratraining.php', 'xolens-pglaratraining'
        );
    }
}