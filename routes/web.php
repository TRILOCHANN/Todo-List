<?php

use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginRegFromController;
use Illuminate\Auth\Events\Registered;

//Registration and Login
Route::controller(LoginRegFromController::class)->group(function(){
        Route::get('/','loginform')->name('login');
        Route::get('/registerform','registerform')->name('registerform');

        Route::post('/store/reg','store')->name('reg.store');
        Route::post('/loginMatch','login')->name('loginMatch');
        Route::get('/dashboard','showdata')->middleware('auth','verified')->name('dashboard');
        
        Route::post('/storetask','storetask')->name('storetask');
        Route::get('/delete/{id}','delete')->name('user.delete');
        Route::get('/edit/{id}','Edit')->name('user.edit');
        Route::put('/updated{id}','updated')->name('user.updated');
        Route::get('/logout','logout')->name('logout');
        Route::get('/email/varify','varificationNotice')->middleware('auth')->name('varification.notice');
        Route::get('/email/varify/{id}/{hash}','varificationVerify')->middleware(['auth', 'signed'])->name('verification.verify');
});
// Route::get('/profile', fn() => redirect('/dashboard'))->name('profile');

// Route::get('/email/verify', function () {
//     return view('auth.verify-email'); // make this view to show "Please verify your email"
// })->middleware('auth')->name('verification.notice');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect()->route('login')->with('Success','Successfully Register !');
// })->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::get('/profile', function () {
//     return redirect('/dashboard');
// })->name('profile');
