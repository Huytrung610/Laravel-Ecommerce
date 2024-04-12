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
// Route::group(['prefix' => 'laravel-filemanager',  'middleware' => [config('backpack.base.middleware_key', 'admin')]], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
// Route::group(['prefix' => 'filemanager', 'middleware' => [config('backpack.base.middleware_key', 'admin')]], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/','App\Http\Controllers\HomeController@index')->name('user');
    
    // Profile
    Route::get('/profile','App\Http\Controllers\FrontendController@Profile')->name('profile');
    Route::post('/update-profile','App\Http\Controllers\HomeController@updateProfile')->name('update.profile');
    Route::post('change-password', 'App\Http\Controllers\HomeController@changePasswordStore')->name('change.password');

    //Customer-address
    Route::post('address-create', 'App\Http\Controllers\CustomerAddressController@addNewAddress')->name('address.add');
    Route::post('update-default-address', 'App\Http\Controllers\CustomerAddressController@updateDefaultAddress')->name('update-default-address');

    
    // Cart section
    Route::get('/add-to-cart/{slug}','CartController@addToCart')->name('add-to-cart');
    Route::post('/add-to-cart','App\Http\Controllers\CartController@singleAddToCart')->name('single-add-to-cart');
    Route::post('cart-update','App\Http\Controllers\CartController@cartUpdate')->name('cart.update');
    Route::get('cart-delete/{id}','App\Http\Controllers\CartController@cartDelete')->name('cart-delete');

    // Checkout section
    Route::get('/checkout','App\Http\Controllers\CartController@checkout')->name('checkout');

    // Order section
    Route::post('cart/order','App\Http\Controllers\OrderController@store')->name('cart.order');
    Route::get('/checkout-success', 'App\Http\Controllers\CartController@showSuccessCheckout')->name('checkout.success');

    // Checkout section
    Route::get('/checkout','App\Http\Controllers\CartController@checkout')->name('checkout');

    //  Order
    Route::get('/order',"HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}',"HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}','HomeController@userOrderDelete')->name('user.order.delete');
    Route::get('/order-detail/{id}','\App\Http\Controllers\OrderController@showOrderDetail')->name('order-detail');

});

//Login/Register/Logout
Route::get('user/login','App\Http\Controllers\FrontendController@login')->name('login.form');
Route::post('user/login','App\Http\Controllers\FrontendController@loginSubmit')->name('login.submit');
Route::post('user/register', 'App\Http\Controllers\FrontendController@registerSubmit')->name('register.submit');
Route::get('user/logout','App\Http\Controllers\FrontendController@logout')->name('user.logout');

//Blog and post
Route::get('/blog','\App\Http\Controllers\Frontend\PostController@listing')->name('blog');
Route::get('/blog-detail/{slug}','\App\Http\Controllers\Frontend\PostController@index')->name('blog.detail');


// Product
//Route::get('product-detail', 'App\Http\Controllers\ProductController@getAllProduct')->name('product-all');
Route::get('product-detail/{slug}', 'App\Http\Controllers\ProductController@productDetail')->name('product-detail');
Route::get('/product-cat/{slug}', 'App\Http\Controllers\ProductController@productCat')->name('product-cat');

Route::get('/product-list/{slug}', 'App\Http\Controllers\ProductController@getAllProductByCategory')->name('product-list');
Route::get('get-product-list', 'App\Http\Controllers\ProductController@getProductList')->name('get-product-list');

Route::match(['get','post'],'/filter','App\Http\Controllers\FrontendController@productFilter')->name('shop.filter');

Route::get('/product', function () {
    return view('frontend.pages.product_detail');
});

//search
Route::get('/search-products','App\Http\Controllers\ProductController@searchProducts')->name('search-products');

//Subcriber 
Route::post('/add-subcriber','App\Http\Controllers\NewsletterSubcriberController@addSubcriber')->name('add-subcriber');

//CMS Page
Route::get('/warranty-policy', [\App\Http\Controllers\CmsContentController::class, 'show'])->name('warranty-policy');
Route::get('/about-us', [\App\Http\Controllers\CmsContentController::class, 'show'])->name('about-us');
Route::get('/shipping-policy', [\App\Http\Controllers\CmsContentController::class, 'show'])->name('shipping-policy');
Route::get('/privacy-policy', [\App\Http\Controllers\CmsContentController::class, 'show'])->name('privacy-policy');
Route::get('/payment-policy', [\App\Http\Controllers\CmsContentController::class, 'show'])->name('payment-policy');


