<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    
    Route::get('/dashboard',[\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::resource('users','\App\Http\Controllers\UsersController');

    Route::get('/profile',[\App\Http\Controllers\AdminController::class, 'profile'])->name('admin-profile');
    Route::resource('/category','\App\Http\Controllers\CategoryController');
    Route::resource('/product','\App\Http\Controllers\ProductController');
    Route::resource('/attribute','\App\Http\Controllers\AttributeController');
    Route::resource('/attribute_value','\App\Http\Controllers\AttributeValueController');

}); // this should be the absolute last line of this file
