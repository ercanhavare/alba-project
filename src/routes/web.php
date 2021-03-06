<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware("auth")->group(function () {
    Route::get("category","CategoryController@index");
    Route::resource("users", "UserController");
    Route::resource("categories", "CategoryController");
    Route::resource("products", "ProductController");
    Route::resource("images", "ImageController");
    Route::resource("baskets", "BasketController");
    Route::resource("payments", "PaymentController");
});

