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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'laravel-filemanager',  'middleware' => [config('backpack.base.middleware_key', 'admin')]], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['prefix' => 'filemanager', 'middleware' => [config('backpack.base.middleware_key', 'admin')]], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('user/login',[FrontendController::class,'login'])->name('login.form');

Route::get('/index', function () {
    return view('frontend.index_fe');
});