<?php

use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Organization', 'middleware' => ['web','auth']], function() {
    include 'organization.php';
    include 'canteen.php';
    include 'device.php';
});

