<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\verifyToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckUserRole;

Route::post('/register',[AuthController::class,'register'])->name('home.registerauth');
Route::post('/login',[AuthController::class,'login'])->name('home.loginauth');
Route::post('/logout',[AuthController::class,'logout'])->middleware(verifyToken::class)->name("home.logout");
Route::post('/refresh',[AuthController::class,'refresh'])->middleware(verifyToken::class)->name("Auth.refresh");
Route::get('/admin',[AdminController::class,'index'])->middleware(CheckUserRole::class);
Route::post('/upload-product', [ProductController::class, 'upload'])->name('product.upload');
Route::get('/all-categories',function(){
    return \App\Models\Category::all();
});

Route::get('/all-users',[AdminController::class,'getAllusers']);
