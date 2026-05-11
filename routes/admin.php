<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth'],
], function () {
    Route::resource('/restaurants', RestaurantController::class);
});
