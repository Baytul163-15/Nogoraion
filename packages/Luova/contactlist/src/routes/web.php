<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Luova\Contactlist\Http\Controllers';

Route::namespace($namespace)->name('contactlist.')->middleware(['web', 'admin.user'])->group(function () {
    Route::get('admin/contactlist/add', 'ContactlistController@add')->name('add');
    Route::get('admin/contactlist', 'ContactlistController@index')->name('index');
    Route::get('admin/contactlist/group', 'ContactlistController@group')->name('group.index');
    Route::post('admin/contactlist/save', 'ContactlistController@store')->name('store');
    Route::post('admin/contactlist/group/save', 'ContactlistController@store_group')->name('group.store');
    Route::get('admin/contactlist/group/{id}/edit', 'ContactlistController@edit_group')->name('group.edit');
    Route::get('admin/contactlist/{id}/edit', 'ContactlistController@edit')->name('edit');
    Route::delete('admin/contactlist/{id}/delete', 'ContactlistController@delete')->name('delete');
    Route::delete('admin/contactlist/group/{id}/delete', 'ContactlistController@group_delete')->name('group.delete');
    Route::get('admin/contactlist/photo/{id}/delete', 'ContactlistController@photodetele')->name('photo.detele');
});

Route::namespace($namespace)->name('contactlist.')->middleware(['web'])->group(function () {
    Route::get('/unit_contact', 'ContactlistController@unit_contact')->name('unit_contact');
     Route::get('admin/contactlist/find', 'ContactlistController@find')->name('find');
});
