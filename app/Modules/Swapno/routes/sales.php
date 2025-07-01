<?php

Route::get('admin-sales-create', [
    'as' => 'admin.sales.create',
    'uses' => 'SalesController@create'
]);

Route::get('admin-sales-index/{type}', [
    'as' => 'admin.sales.index',
    'uses' => 'SalesController@index'
]);

Route::post('admin-sales-store',[
    'as' => 'admin.sales.store',
    'uses' => 'SalesController@store'
]);

Route::get('admin-sales-edit/{id}',[
    'as' => 'admin.sales.edit',
    'uses' => 'SalesController@edit'
]);

Route::PATCH('admin-sales-update/{id}',[
    'as' => 'admin.sales.update',
    'uses' => 'SalesController@update'
]);

Route::get('admin-sales-delete/{id}',[
    'as' => 'admin.sales.delete',
    'uses' => 'SalesController@delete'
]);




