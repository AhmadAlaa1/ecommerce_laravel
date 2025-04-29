<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\verifyToken;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class,'register'])->name('home.registerauth');
Route::post('/login',[AuthController::class,'login'])->name('home.loginauth');
Route::post('/logout',[AuthController::class,'logout'])->middleware(verifyToken::class)->name("home.logout");
Route::post('/refresh',[AuthController::class,'refresh'])->middleware(verifyToken::class)->name("Auth.refresh");
