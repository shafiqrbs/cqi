<?php

Route::get('admin-kpi-create', [
    'as' => 'admin.kpi.create',
    'uses' => 'SwapnoOverviewController@create'
]);

Route::get('admin-kpi-index', [
    'as' => 'admin.kpi.index',
    'uses' => 'SwapnoOverviewController@index'
]);

Route::post('admin-kpi-parameter-store',[
    'as' => 'admin.kpi.parameter.store',
    'uses' => 'SwapnoOverviewController@store'
]);

Route::get('admin-kpi-parameter-delete/{id}',[
    'as' => 'admin.kpi.parameter.delete',
    'uses' => 'SwapnoOverviewController@kpiValuesDelete'
]);

Route::get('admin-kpi-edit/{id}',[
    'as' => 'admin.kpi.edit',
    'uses' => 'SwapnoOverviewController@edit'
]);

Route::PATCH('admin-kpi-update/{id}',[
    'as' => 'admin.kpi.update',
    'uses' => 'SwapnoOverviewController@update'
]);

Route::get('admin-kpi-delete/{id}',[
    'as' => 'admin.kpi.delete',
    'uses' => 'SwapnoOverviewController@delete'
]);

Route::get('admin-kpi-total-create', [
    'as' => 'admin.kpi.total.create',
    'uses' => 'SwapnoOverviewController@create'
]);

Route::get('admin-kpi-total-index', [
    'as' => 'admin.kpi.total.index',
    'uses' => 'SwapnoOverviewController@index'
]);

Route::post('admin-kpi-total-store',[
    'as' => 'admin.kpi.total.store',
    'uses' => 'SwapnoOverviewController@store'
]);

Route::get('admin-kpi-total-edit/{id}',[
    'as' => 'admin.kpi.total.edit',
    'uses' => 'SwapnoOverviewController@edit'
]);

Route::PATCH('admin-kpi-total-update/{id}',[
    'as' => 'admin.kpi.total.update',
    'uses' => 'SwapnoOverviewController@update'
]);

Route::get('admin-kpi-total-inactive/{id}',[
    'as' => 'admin.kpi.total.inactive',
    'uses' => 'SwapnoOverviewController@inactive'
]);

Route::get('admin-kpi-total-delete/{id}',[
    'as' => 'admin.kpi.total.delete',
    'uses' => 'SwapnoOverviewController@delete'
]);







