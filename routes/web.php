<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['guest','PreventBackHistory'])->group( function (){      
    Route::view('/login', 'dashboard.user.login')->name('login');
    Route::view('/register', 'dashboard.user.register')->name('register');
    Route::post('/create',[UserController::class, 'create'])->name('create');
    Route::post('/check',[UserController::class, 'check'])->name('check');
});

Route::middleware(['auth','PreventBackHistory'])->group( function (){
    Route::group(['domain' => '{domain}.'.env('LOCAL_URL')], function () {
        Route::view('/home', 'dashboard.user.home')->name('home');
        Route::view('/member', 'dashboard.user.home')->name('member');
        Route::view('/support', 'dashboard.user.home')->name('support');
        Route::view('/system', 'dashboard.user.home')->name('system');
        Route::post('/logout',[UserController::class,'logout'])->name('logout');
    });
});
    





