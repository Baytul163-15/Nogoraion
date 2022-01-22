<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Luova\Widget\Http\Controllers';

Route::namespace($namespace)->name('lvwidget.')->middleware(['web', 'admin.user'])->group(function () {
    Route::get('admin/lvwidget/add', 'WidgetController@add')->name('add');
    Route::get('admin/lvwidget', 'WidgetController@index')->name('index');
    Route::get('admin/lvwidget/group', 'WidgetController@group')->name('group.index');
    Route::post('admin/lvwidget/save', 'WidgetController@store')->name('store');
    Route::post('admin/lvwidget/group/save', 'WidgetController@store_group')->name('group.store');
    Route::get('admin/lvwidget/group/{id}/edit', 'WidgetController@edit_group')->name('group.edit');
    Route::get('admin/lvwidget/{id}/edit', 'WidgetController@edit')->name('edit');
    Route::get('admin/lvwidget/{id}/copy', 'WidgetController@copy')->name('copy');
    Route::delete('admin/lvwidget/{id}/delete', 'WidgetController@delete')->name('delete');
    Route::delete('admin/lvwidget/group/{id}/delete', 'WidgetController@group_delete')->name('group.delete');
    Route::get('admin/lvwidget/find', 'WidgetController@find')->name('find');
    Route::get('admin/lvwidget/photo/{id}/delete', 'WidgetController@photodetele')->name('photo.detele');

    Route::get('admin/lvwidget/ajax/rowitem', 'WidgetController@ajax_rowitem')->name('ajax.rowitem');
});

Route::namespace($namespace)->name('lvwidget.')->middleware(['web'])->group(function () {
    Route::get('/unit_contact', 'WidgetController@unit_contact')->name('unit_contact');
});

Route::namespace($namespace)->middleware(['web'])->name('admin.')->group(function () {
    Route::get('admin/licence', 'WidgetController@licence')->name('setting.licence');
});

// Route::get('check/widget', function () {
//     return " wow your model working";
// });
