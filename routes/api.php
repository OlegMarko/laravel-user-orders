<?php

use App\Http\Controllers\Api\V1\{OrderController, ProductController, UserController};
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('products', ProductController::class);
});
