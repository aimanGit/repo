<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NlController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;

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
    return view('home');
});

Route::controller(NlController::class)->group(function(){
    Route::get('list','index')->name('list');
    Route::get('list/second','second')->name('list.second');
    Route::get('/list/edit/{id}','edit')->name('list.edit');
    Route::post('/list/update/{id}','update')->name('list.update');
    Route::post('/list/add','store')->name('list.add');
    Route::post('/list/delete','destroy')->name('list.delete');
    Route::get('/list/republish/{id}','republish')->name('list.republish');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/second', [HomeController::class, 'second'])->name('home.second');


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
