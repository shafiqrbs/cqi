<?php

Route::get('admin-event-create', [
    'as' => 'admin.event.create',
    'uses' => 'EventController@create'
]);

Route::get('admin-event-index', [
    'as' => 'admin.event.index',
    'uses' => 'EventController@index'
]);

Route::post('admin-event-store',[
    'as' => 'admin.event.store',
    'uses' => 'EventController@store'
]);

Route::get('admin-event-edit/{id}',[
    'as' => 'admin.event.edit',
    'uses' => 'EventController@edit'
]);

Route::PATCH('admin-event-update/{id}',[
    'as' => 'admin.event.update',
    'uses' => 'EventController@update'
]);

Route::get('admin-event-delete/{id}',[
    'as' => 'admin.event.delete',
    'uses' => 'EventController@delete'
]);




