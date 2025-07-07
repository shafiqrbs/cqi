<?php

Route::get('admin-gallery-create', [
    'as' => 'admin.gallery.create',
    'uses' => 'GalleryController@create'
]);

Route::get('admin-gallery-index', [
    'as' => 'admin.gallery.index',
    'uses' => 'GalleryController@index'
]);

Route::post('admin-gallery-store',[
    'as' => 'admin.gallery.store',
    'uses' => 'GalleryController@store'
]);

Route::get('admin-gallery-edit/{id}',[
    'as' => 'admin.gallery.edit',
    'uses' => 'GalleryController@edit'
]);

Route::PATCH('admin-gallery-update/{id}',[
    'as' => 'admin.gallery.update',
    'uses' => 'GalleryController@update'
]);

Route::get('admin-gallery-delete/{id}',[
    'as' => 'admin.gallery.delete',
    'uses' => 'GalleryController@delete'
]);

Route::post('/photo-gallery-image-store', array_merge(['uses' => 'GalleryController@storePhotoGalleryImage']))->name('store_photo_gallery_image');
Route::get('/ajax/photo-gallery-image/delete/{id}' ,'GalleryController@deletePhotoGalleryImage')->name('delete_photo_gallery_image');




