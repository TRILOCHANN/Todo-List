<?php

use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\LoginRegFromController;


// Route::get('/',[TodoController::class,'index'])->name('index');
// Route::post('/store',[TodoController::class,'store'])->name('user.store');
// Route::get('/',[TodoController::class,'show'])->name('ShowData');

//Registration and Login
Route::controller(LoginRegFromController::class)->group(function(){
        Route::get('/','loginform')->name('loginform');
        Route::get('/registerform','registerform')->name('registerform');

        Route::post('/store/reg','store')->name('reg.store');
        Route::post('/loginMatch','login')->name('loginMatch');
        Route::get('/dashboard','showdata')->middleware('auth')->name('dashboard');
        Route::post('/storetask','storetask')->name('storetask');

        Route::get('/delete/{id}','delete')->name('user.delete');
        Route::get('/edit/{id}','Edit')->name('user.edit');
        Route::put('/updated{id}','updated')->name('user.updated');
        Route::get('/logout','logout')->name('logout');
});
