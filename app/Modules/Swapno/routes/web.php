<?php

use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Swapno', 'middleware' => ['web','auth']], function() {
    include 'swapno.php';
    include 'sales.php';
    include 'particular.php';
    include 'gallery.php';
    include 'swapno-overview.php';
});