<?php

Route::get('admin-swapno-create', [
    'as' => 'admin.swapno.create',
    'uses' => 'SwapnoController@create'
]);

Route::get('admin-swapno-index', [
    'as' => 'admin.swapno.index',
    'uses' => 'SwapnoController@index'
]);

Route::post('admin-swapno-store',[
    'as' => 'admin.swapno.store',
    'uses' => 'SwapnoController@store'
]);

Route::get('admin-swapno-edit/{id}',[
    'as' => 'admin.swapno.edit',
    'uses' => 'SwapnoController@edit'
]);

Route::PATCH('admin-swapno-update/{id}',[
    'as' => 'admin.swapno.update',
    'uses' => 'SwapnoController@update'
]);

Route::get('admin-swapno-inactive/{id}',[
    'as' => 'admin.swapno.inactive',
    'uses' => 'SwapnoController@inactive'
]);

Route::get('admin-swapno-delete/{id}',[
    'as' => 'admin.swapno.delete',
    'uses' => 'SwapnoController@delete'
]);


Route::get('admin-swapno-total-create', [
    'as' => 'admin.swapno.total.create',
    'uses' => 'SwapnoTotalController@create'
]);

Route::get('admin-swapno-total-index', [
    'as' => 'admin.swapno.total.index',
    'uses' => 'SwapnoTotalController@index'
]);

Route::post('admin-swapno-total-store',[
    'as' => 'admin.swapno.total.store',
    'uses' => 'SwapnoTotalController@store'
]);

Route::get('admin-swapno-total-edit/{id}',[
    'as' => 'admin.swapno.total.edit',
    'uses' => 'SwapnoTotalController@edit'
]);

Route::PATCH('admin-swapno-total-update/{id}',[
    'as' => 'admin.swapno.total.update',
    'uses' => 'SwapnoTotalController@update'
]);

Route::get('admin-swapno-total-inactive/{id}',[
    'as' => 'admin.swapno.total.inactive',
    'uses' => 'SwapnoTotalController@inactive'
]);

Route::get('admin-swapno-total-delete/{id}',[
    'as' => 'admin.swapno.total.delete',
    'uses' => 'SwapnoTotalController@delete'
]);







