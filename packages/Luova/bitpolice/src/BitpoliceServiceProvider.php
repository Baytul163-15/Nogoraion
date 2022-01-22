<?php

namespace Luova\Bitpolice;

use Illuminate\Support\ServiceProvider;

class BitpoliceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'bitpolice');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/bitpolice')
        ]);



        if (file_exists($file =  __DIR__ . '/Helpers/bitpolice_helpers.php')) {
            require $file;
        }
    }
}
