<?php

namespace Luova\Contactlist;

use Illuminate\Support\ServiceProvider;

class ContactlistServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'contactlist');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/contactlist')
        ]);



        if (file_exists($file =  __DIR__ . '/Helpers/contactlist_helpers.php')) {
            require $file;
        }
    }
}
