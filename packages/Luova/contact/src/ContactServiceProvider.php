<?php

namespace Luova\Contact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'contact');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/Config/contact.php', 'contact');

        if (file_exists($file =  __DIR__ . '/Helpers/contact_helpers.php')) {
            require $file;
        }

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/contact'),
            __DIR__ . '/Config/contact.php' => config_path('contact.php')
        ], 'lv_contact');

        // php artisan vendor:publish --tag=lv_contact --force
    }

    // public function register()
    // {

    //     $this->mergeConfigFrom(__DIR__ . '/Config/contact.php', 'contact');
    // }
}
