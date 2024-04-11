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
    


    Route::get('/dashboard',[\App\Http\Controllers\AdminController::class, 'getRevenueByMonth'])->name('admin');
    Route::resource('users','\App\Http\Controllers\UsersController');
    // Route::get('/file-manager',function(){
    //     return view('backend.layouts.file-manager');
    // })->name('file-manager');

    Route::get('/profile',[\App\Http\Controllers\AdminController::class, 'profile'])->name('admin-profile');
    Route::resource('/category','\App\Http\Controllers\CategoryController');
    
    Route::resource('/attribute','\App\Http\Controllers\AttributeController');
    Route::get('attribute-edit/{id}',[\App\Http\Controllers\AttributeController::class,'edit']);
    Route::post('attribute/update/{id}', [\App\Http\Controllers\AttributeController::class, 'update']);
    Route::get('get-attributes',  [\App\Http\Controllers\AttributeController::class, 'getAttributes'])->name('admin.get-attributes');
    Route::get('get-attribute-values', [\App\Http\Controllers\AttributeController::class, 'getAttributeValues'])->name('admin.get-attribute-values');    

    // Banner
    Route::resource('banner','\App\Http\Controllers\BannerController');

    //Products
    Route::resource('/product','\App\Http\Controllers\ProductController');

    Route::get('/product/{id}/has-variants', [\App\Http\Controllers\ProductController::class, 'updateHasVariants'])->name('product.has_variants');
    Route::get('/product/{id}/save-variants', [\App\Http\Controllers\ProductController::class, 'createVariant'])->name('product.save_variants');

    //Brand
    Route::resource('/brand', '\App\Http\Controllers\BrandController');
    
    // Password Change
    Route::get('change-password', [\App\Http\Controllers\AdminController::class, 'changePassword'])->name('change.password.form');
    Route::post('change-password', [\App\Http\Controllers\AdminController::class,'changPasswordStore'])->name('admin.change.password');

    //Customer address
    Route::resource('customer-address', '\App\Http\Controllers\CustomerAddressController');
    Route::get('customer-address/show/{id}', [\App\Http\Controllers\CustomerAddressController::class, 'showFormEditProfile']);
    Route::post('customer-address/update/{id}', [\App\Http\Controllers\CustomerAddressController::class, 'update']);
    
    // Newsletter Subcriber
    Route::get('subcribers',  [\App\Http\Controllers\NewsletterSubcriberController::class, 'index'])->name('subcriber');
    Route::get('update-subscriber-status',[\App\Http\Controllers\NewsletterSubcriberController::class,'updateSubscriberStatus'])->name('update-subscriber-status');
    Route::delete('subcribers/destroy/{id}', [\App\Http\Controllers\NewsletterSubcriberController::class, 'destroy'])->name('subscriber.destroy');
    Route::get('export-subscibers', [\App\Http\Controllers\NewsletterSubcriberController::class,'exportSubscribers'])->name('export-subscibers');
    
    //Order
    Route::resource('/order','\App\Http\Controllers\OrderController');
    Route::get('order/receipt/index','\App\Http\Controllers\OrderController@getOrderReceipt')->name('order.receipt.index');
    Route::get('order/receipt/show/{id}','\App\Http\Controllers\OrderController@showOrderReceipt')->name('order.receipt.show');
    Route::get('order/receipt/edit/{id}','\App\Http\Controllers\OrderController@editOrderReceipt')->name('order.receipt.edit');
    Route::delete('order/receipt/destroy/{id}',[\App\Http\Controllers\OrderController::class,'destroyOrderReceipt'])->name('order.receipt.destroy');

    // Post
    Route::resource('/post','\App\Http\Controllers\PostController');

    // CMS Content
    Route::resource('/cms-content','\App\Http\Controllers\CmsContentController');
    
    //General Settings
    Route::get('general-setting',[\App\Http\Controllers\GeneralSettingController::class,'index'])->name('settings');
    Route::post('setting/update',[\App\Http\Controllers\GeneralSettingController::class, 'update'])->name('settings.update');

    //Page Settings
    Route::get('page-setting',[\App\Http\Controllers\PageSettingController::class,'index'])->name('page-setting');
    Route::post('page-setting/update',[\App\Http\Controllers\PageSettingController::class, 'update'])->name('page-setting.update');
   
}); // this should be the absolute last line of this file
