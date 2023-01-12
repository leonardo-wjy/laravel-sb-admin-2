<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

// php artisan make:controller DosenController
class UserController extends Controller
{
    public function index() 
    {
        if (request()->ajax()) {
            $users = array(
            [
                "id" => 1,
                "name" => "tes",
                "email" => "tes@gmail.com"
            ],
            [
                "id" => 2,
                "name" => "andi",
                "email" => "andi@gmail.com"
            ]
            );
            // $users = User::query();
            return DataTables::of($users)->make();
        }

        return view('user');
    }
}