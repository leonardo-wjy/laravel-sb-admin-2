<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/book', 'index');
    Route::post('/book/create', 'create');
    Route::delete('/book', 'updateStatus');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
    Route::post('/user/create', 'create');
    Route::patch('user/update/{id}', 'update');
    Route::post('/user/update-status', 'updateStatus');
});
