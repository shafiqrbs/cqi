<?php

Route::get('admin-particular-create', [
    'as' => 'admin.particular.create',
    'uses' => 'ParticularController@create'
]);

Route::get('admin-particular-index', [
    'as' => 'admin.particular.index',
    'uses' => 'ParticularController@index'
]);

Route::post('admin-particular-store',[
    'as' => 'admin.particular.store',
    'uses' => 'ParticularController@store'
]);

Route::get('admin-particular-edit/{id}',[
    'as' => 'admin.particular.edit',
    'uses' => 'ParticularController@edit'
]);

Route::PATCH('admin-particular-update/{id}',[
    'as' => 'admin.particular.update',
    'uses' => 'ParticularController@update'
]);

Route::get('admin-particular-delete/{id}',[
    'as' => 'admin.particular.delete',
    'uses' => 'ParticularController@delete'
]);




