<?php

namespace Scoutium\RMC\Providers;

use Illuminate\Support\ServiceProvider;

class ScoutiumRMCServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/rmc.php' => config_path('rmc.php'),
        ]);
    }
}