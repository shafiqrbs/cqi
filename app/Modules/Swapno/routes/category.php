<?php

Route::get('admin-category-create', [
    'as' => 'admin.category.create',
    'uses' => 'CategoryController@create'
]);

Route::get('admin-category-index', [
    'as' => 'admin.category.index',
    'uses' => 'CategoryController@index'
]);

Route::post('admin-category-store',[
    'as' => 'admin.category.store',
    'uses' => 'CategoryController@store'
]);

Route::get('admin-category-edit/{id}',[
    'as' => 'admin.category.edit',
    'uses' => 'CategoryController@edit'
]);

Route::PATCH('admin-category-update/{id}',[
    'as' => 'admin.category.update',
    'uses' => 'CategoryController@update'
]);

Route::get('admin-category-delete/{id}',[
    'as' => 'admin.category.delete',
    'uses' => 'CategoryController@delete'
]);




