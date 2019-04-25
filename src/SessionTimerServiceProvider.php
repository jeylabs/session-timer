<?php

namespace Jeylabs\SessionTimer;

use Illuminate\Support\ServiceProvider;

class SessionTimerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = __DIR__ . '/config/session-timer.php';
        $jsSource = __DIR__ . '/resources/assets/main.js';
        $this->publishes([$source => config_path('session-timer.php'), $jsSource => public_path("assets/vendor/session-timer.js")]);
        $this->mergeConfigFrom($source, 'session-timer');
    }

    public function register()
    {
        if (function_exists("registerBindings")) {
            $this->registerBindings($this->app);
        }
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'sessionTimer');
    }
}