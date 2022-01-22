<?php

use Illuminate\Support\Facades\Route;


Route::get('check/weather', function () {


    $data =  lvWeatherCall([
        'city' => null,
        'lat' => 24.37,
        'lon' => 88.60
    ]);

    dd($data);
});
