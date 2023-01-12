<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// php artisan make:controller DosenController
//composer create-project laravel/laravel laravel-datatable
//composer require yajra/laravel-datatables-oracle
//composer require yajra/laravel-datatables-buttons

class HomeController extends Controller
{
    public function index() 
    {
        return view('home');
    }
}
