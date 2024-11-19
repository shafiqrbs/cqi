<?php

Route::get('admin-device-create', [
    'as' => 'admin.device.create',
    'uses' => 'DeviceController@create'
]);

Route::get('admin-device-createlv', [
    'as' => 'admin.device.createlv',
    'uses' => 'DeviceController@createlv'
]);


Route::get('admin-device-index', [
    'as' => 'admin.device.index',
    'uses' => 'DeviceController@index'
]);

Route::post('admin-device-store',[
    'as' => 'admin.device.store',
    'uses' => 'DeviceController@store'
]);

Route::get('admin-device-edit/{id}',[
    'as' => 'admin.device.edit',
    'uses' => 'DeviceController@edit'
]);

Route::PATCH('admin-device-update/{id}',[
    'as' => 'admin.device.update',
    'uses' => 'DeviceController@update'
]);

Route::get('admin-device-inactive/{id}',[
    'as' => 'admin.device.inactive',
    'uses' => 'DeviceController@inactive'
]);

Route::get('admin-device-delete/{id}',[
    'as' => 'admin.device.delete',
    'uses' => 'DeviceController@delete'
]);




