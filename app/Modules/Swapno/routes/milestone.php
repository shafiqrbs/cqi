<?php

Route::get('admin-milestone-create', [
    'as' => 'admin.milestone.create',
    'uses' => 'MilestoneController@create'
]);

Route::get('admin-milestone-index', [
    'as' => 'admin.milestone.index',
    'uses' => 'MilestoneController@index'
]);

Route::post('admin-milestone-store',[
    'as' => 'admin.milestone.store',
    'uses' => 'MilestoneController@store'
]);

Route::get('admin-milestone-edit/{id}',[
    'as' => 'admin.milestone.edit',
    'uses' => 'MilestoneController@edit'
]);

Route::PATCH('admin-milestone-update/{id}',[
    'as' => 'admin.milestone.update',
    'uses' => 'MilestoneController@update'
]);

Route::get('admin-milestone-delete/{id}',[
    'as' => 'admin.milestone.delete',
    'uses' => 'MilestoneController@delete'
]);




