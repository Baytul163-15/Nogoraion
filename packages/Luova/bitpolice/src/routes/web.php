<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Luova\Bitpolice\Http\Controllers';

Route::namespace($namespace)->name('bitpolice.')->middleware(['web', 'admin.user'])->group(function () {
    Route::get('admin/bitpolice/add', 'BitpoliceController@add')->name('add');
    Route::get('admin/bitpolice', 'BitpoliceController@index')->name('index');
    Route::get('admin/bitpolice/group', 'BitpoliceController@group')->name('group.index');
    Route::post('admin/bitpolice/save', 'BitpoliceController@store')->name('store');
    Route::post('admin/bitpolice/group/save', 'BitpoliceController@store_group')->name('group.store');
    Route::get('admin/bitpolice/group/{id}/edit', 'BitpoliceController@edit_group')->name('group.edit');
    Route::get('admin/bitpolice/{id}/edit', 'BitpoliceController@edit')->name('edit');
    Route::delete('admin/bitpolice/{id}/delete', 'BitpoliceController@delete')->name('delete');
    Route::delete('admin/bitpolice/group/{id}/delete', 'BitpoliceController@group_delete')->name('group.delete');
    Route::get('admin/bitpolice/photo/{id}/delete', 'BitpoliceController@photodetele')->name('photo.detele');
});

Route::namespace($namespace)->name('bitpolice.')->middleware(['web'])->group(function () {
    Route::get('/bitpolice', 'BitpoliceController@front_view')->name('front.view');
    Route::get('/front_details', 'BitpoliceController@front_details')->name('front.details');
    Route::get('admin/bitpolice/find', 'BitpoliceController@find')->name('find');
});
