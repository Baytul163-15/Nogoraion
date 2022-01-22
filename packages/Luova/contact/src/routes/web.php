<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Luova\Contact\Http\Controllers';

Route::namespace($namespace)->name('contact.')->middleware(['web'])->group(function () {
    Route::post('contact/save', 'ContactController@store')->name('store');
});

Route::namespace($namespace)->name('contact.')->middleware(['web'])->group(function () {
    Route::get('admin/contact', 'ContactController@index')->name('index');
    Route::get('admin/contact/{id}/view', 'ContactController@view')->name('view');
    Route::delete('admin/contact/{id}/delete', 'ContactController@delete')->name('delete');
});


Route::get('check/contact', function () {
    return " wow your model working";
});
