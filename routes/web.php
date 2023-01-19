<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PinjamController;
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
    Route::patch('/book/update/{id}', 'update');
    Route::delete('/book', 'updateStatus');
    Route::get('/book/print', 'print');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::post('/category/create', 'create');
    Route::patch('/category/update/{id}', 'update');
    Route::delete('/category', 'updateStatus');
});

Route::controller(PenerbitController::class)->group(function () {
    Route::get('/penerbit', 'index');
    Route::post('/penerbit/create', 'create');
    Route::patch('/penerbit/update/{id}', 'update');
    Route::delete('/penerbit', 'updateStatus');
});

Route::controller(PinjamController::class)->group(function () {
    Route::get('/pinjam', 'index');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
    Route::post('/user/create', 'create');
    Route::patch('/user/update/{id}', 'update');
    Route::post('/user/update-status', 'updateStatus');
});
