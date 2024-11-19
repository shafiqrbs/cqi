<?php

Route::get('admin-canteen-create', [
    'as' => 'admin.canteen.create',
    'uses' => 'CanteenController@create'
]);

Route::get('admin-canteen-createlv', [
    'as' => 'admin.canteen.createlv',
    'uses' => 'CanteenController@createlv'
]);


Route::get('admin-canteen-index', [
    'as' => 'admin.canteen.index',
    'uses' => 'CanteenController@index'
]);

Route::post('admin-canteen-store',[
    'as' => 'admin.canteen.store',
    'uses' => 'CanteenController@store'
]);

Route::get('admin-canteen-edit/{id}',[
    'as' => 'admin.canteen.edit',
    'uses' => 'CanteenController@edit'
]);

Route::PATCH('admin-canteen-update/{id}',[
    'as' => 'admin.canteen.update',
    'uses' => 'CanteenController@update'
]);

Route::get('admin-canteen-inactive/{id}',[
    'as' => 'admin.canteen.inactive',
    'uses' => 'CanteenController@inactive'
]);

Route::get('admin-canteen-delete/{id}',[
    'as' => 'admin.canteen.delete',
    'uses' => 'CanteenController@delete'
]);

Route::get('admin-canteen-report',[
    'as' => 'admin.canteen.report',
    'uses' => 'CanteenController@reportWithGraph'
]);

Route::post('admin-canteen-report-value',[
    'as' => 'admin.canteen.report.value',
    'uses' => 'CanteenController@reportWithGraphValue'
]);




