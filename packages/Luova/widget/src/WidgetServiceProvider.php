<?php

namespace Luova\Widget;

use Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $pw = 'xhmx' . Request::server("SERVER_NAME") . 'xhmx';


        $make = Hash::make($pw);

        $hashed = Hash::make($pw);
         // dump(Request::server("SERVER_NAME"));
         // dd($hashed);
        $hashed = config('app.mylicence');

        $licence = Hash::check($pw, $hashed);
        // dd($licence);
        if ($licence || Request::is('admin/licence')) {
        } else {
            redirect('admin/licence')->send();
        }

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'widget');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/lvwidget')
        ]);



        if (file_exists($file =  __DIR__ . '/Helpers/widget_helpers.php')) {
            require $file;
        }
    }
}
