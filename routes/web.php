<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\verifyToken;

Route::get('/', function () {
    return to_route('home.index');
});

Route::get('/home',[HomeController::class,'index'])->name('home.index');

Route::get('/home/login',[HomeController::class,'login'])->name('home.login');

Route::get('/home/register',[HomeController::class,'register'])->name('home.register');

Route::get('/shop',[ShopController::class,'index'])->name('shop.index');

Route::post('/shop',[ShopController::class,'store'])->name('shop.store');

Route::get('/shop/cart',[CartController::class,'index'])->name('cart.index');

Route::post('/shop/cart',[CartController::class,'store'])->name('cart.store');

Route::put('/shop/cart',[CartController::class,'update'])->name('cart.update');

Route::get('/shop/{name}',[ShopController::class,'show'])->name('shop.show');

Route::post('/shop/{name}',[ShopController::class,'comment'])->name('shop.comment');

Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

Route::post('/contact',[ContactController::class,'store'])->name('contact.store');

Route::get('/shop/cart/checkout',[CheckoutController::class,'index'])->name('checkout.index');

Route::post('/shop/cart/checkout',[CheckoutController::class,'store'])->name('checkout.store');

Route::get('admin',[AdminController::class,'index'])->name('admin.index');

// Route::middleware(['jwt.auth', 'admin.role'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index']);
// });
