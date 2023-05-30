<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/logout', function () {
//     return view('auth.login');
// });

Auth::routes();       


Route::get('/','App\Http\Controllers\FrontendController@home')->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::group(['prefix' => 'laravel-filemanager',  'middleware' => [config('backpack.base.middleware_key', 'admin')]], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['prefix' => 'filemanager', 'middleware' => [config('backpack.base.middleware_key', 'admin')]], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    // Profile
    Route::get('/profile','App\Http\Controllers\FrontendController@Profile')->name('profile');
    Route::post('/update-profile','App\Http\Controllers\HomeController@updateProfile')->name('update.profile');
    Route::post('change-password', 'App\Http\Controllers\HomeController@changePasswordStore')->name('change.password');

    //Customer-address
    Route::post('address-create', 'App\Http\Controllers\CustomerAddressController@addNewAddress')->name('address.add');

    
    // Cart section
    Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart');
    Route::post('/add-to-cart','App\Http\Controllers\CartController@singleAddToCart')->name('single-add-to-cart');

});

//Login/Register/Logout
Route::get('user/login','App\Http\Controllers\FrontendController@login')->name('login.form');
Route::post('user/login','App\Http\Controllers\FrontendController@loginSubmit')->name('login.submit');
Route::post('user/register', 'App\Http\Controllers\FrontendController@registerSubmit')->name('register.submit');
Route::get('user/logout','App\Http\Controllers\FrontendController@logout')->name('user.logout');


Route::get('/index', function () {
    return view('frontend.index');
});
Route::get('/shop', function () {
    return view('frontend.pages.shop');
});

// Product
Route::get('product-detail', 'App\Http\Controllers\ProductController@getAllProduct')->name('product-all');
Route::get('product-detail/{slug}', 'App\Http\Controllers\ProductController@productDetail')->name('product-detail');
Route::get('/product-cat/{slug}', 'App\Http\Controllers\ProductController@productCat')->name('product-cat');
Route::match(['get','post'],'/filter','App\Http\Controllers\FrontendController@productFilter')->name('shop.filter');


// Checkout section
Route::get('/checkout','App\Http\Controllers\CartController@checkout')->name('checkout');

Route::get('/product', function () {
    return view('frontend.pages.product_detail');
});

Route::get('/cart', function () {
    return view('frontend.pages.checkout');
});

Route::get('/aboutus', function () {
    return view('frontend.pages.aboutus');
});


