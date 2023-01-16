<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

// php artisan make:controller DosenController
class LoginController extends Controller
{
    public function __construct(){

    }

    //get page login
    public function index() 
    {
        return view('login');
    }
}