<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', 'UserController@index')->name('home');
Route::post('/search/product', 'UserController@search')->name('search');
Route::get('/   ', 'UserController@products')->name('home.products');
Route::get('/detail/{product:slug}', 'UserController@detail')->name('detail');
Route::get('/category/{category:slug}', 'UserController@category')->name('home.category');

Route::get('/cart', 'UserController@cart')->name('cart');
Route::get('/cart/store/{product:slug}', 'UserController@storeCart')->name('storeCart');
Route::patch('/cart/update/amount', 'UserController@updateAmount')->name('updateAmount');
Route::delete('/cart/delete', 'UserController@deleteCart')->name('deleteCart');
Route::get('/profile', [UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/profile/transaction', [UserController::class, 'transaction'])->name('transaction');
Route::get('/profile/transaction/{invoice}/view', [UserController::class, 'view'])->name('transaction.view');
Route::get('/profile/transaction/{invoice}/update', [UserController::class, 'update'])->name('transaction.update');
Route::get('/profile/history', [UserController::class, 'history'])->name('transaction.history');
Route::get('/profile/edit-profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/change-password', [UserController::class, 'password'])->name('password');
Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');
Route::post('/payment', [InvoiceController::class, 'payment'])->name('payment');
Route::get('/payment/confirm', [InvoiceController::class, 'payment_confirm'])->name('payment.confirm');
Route::post('/payment/proof', [InvoiceController::class, 'payment_proof'])->name('payment.proof');

Route::post('/get/cities', 'UserController@get_cities');
Route::post('/get/subdistricts', 'UserController@get_subdistricts');
Route::post('/get/service', 'UserController@get_service');
Route::post('/get/courier', 'UserController@get_courier');

Route::get('/login', 'AuthorizationController@login')->name('login');
Route::get('/register', 'AuthorizationController@register')->name('register');
Route::post('/postregister', 'AuthorizationController@postregister')->name('post.register');
Route::post('/auth', 'AuthorizationController@auth')->name('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/backend-panel', 'AuthorizationController@dashboard')->name('dashboard');
    // Product
    Route::get('/backend-panel/product', 'ProductController@index')->name('product');
    Route::get('/backend-panel/product/create', 'ProductController@create')->name('product.create');
    Route::post('/backend-panel/product/store', 'ProductController@store')->name('product.store');
    Route::get('/backend-panel/product/{product:slug}/edit', 'ProductController@edit')->name('product.edit');
    Route::patch('/backend-panel/product/{product:slug}/update', 'ProductController@update')->name('product.update');
    Route::get('/backend-panel/product/{product:slug}/view', 'ProductController@view')->name('product.view');
    Route::delete('/backend-panel/product/{product:slug}/delete', 'ProductController@delete')->name('product.delete');
    
    // Category
    Route::get('/backend-panel/category', 'CategoryController@index')->name('category');
    Route::get('/backend-panel/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/backend-panel/category/store', 'CategoryController@store')->name('category.store');
    Route::get('/backend-panel/category/{category:slug}/edit', 'CategoryController@edit')->name('category.edit');
    Route::patch('/backend-panel/category/{category:slug}/update', 'CategoryController@update')->name('category.update');
    Route::delete('/backend-panel/category/{category:slug}/delete', 'CategoryController@delete')->name('category.delete');

    // Order
    Route::get('/backend-panel/order', 'AdminController@order')->name('order');
    Route::get('/backend-panel/order/{invoice}/view', 'AdminController@view')->name('order.view');
    Route::get('/backend-panel/order/{invoice}/update', 'AdminController@update')->name('order.update');

    // Payment Proof
    Route::get('/backend-panel/payment-proof', 'AdminController@payment_proof')->name('admin.proof');
    Route::get('/backend-panel/confirm/{proof}', 'AdminController@payment_confirm')->name('admin.confirm');

    Route::get('/logout', "AuthorizationController@logout")->name('logout');
});