<?php

namespace Luova\Weather;

use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        if (file_exists($file =  __DIR__ . '/Helpers/weather_helpers.php')) {
            require $file;
        }

        $this->publishes([
            __DIR__ . '/Config/weather.php' => config_path('weather.php')
        ], 'lv_weather');

        // php artisan vendor:publish --tag=lv_weather--force
    }

    public function register()
    {

        $this->mergeConfigFrom(__DIR__ . '/Config/weather.php', 'weather');
    }
}
