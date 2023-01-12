<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// php artisan make:controller DosenController
class UserController extends Controller
{
    public function index() 
    {
        return view('user');
    }
}