<?php

namespace Jeylabs\SessionTimer;

use Illuminate\Support\ServiceProvider;

class SessionTimerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = __DIR__ . '/config/session-timer.php';
        $this->publishes([$source => config_path('session-timer.php')]);
        $this->mergeConfigFrom($source, 'session-timer');
    }

    public function register()
    {
        if (function_exists("registerBindings")) {
            $this->registerBindings($this->app);
        }
        
        $this->loadViewsFrom('resources/views/index', 'sessionTimer');
    }
}