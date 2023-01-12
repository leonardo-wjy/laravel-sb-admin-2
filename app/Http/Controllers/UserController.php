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
                "no" => 1,
                "id" => 1,
                "name" => "tes",
                "email" => "tes@gmail.com",
                "phone" => "0812388383332"
            ],
            [
                "no" => 2,
                "id" => 2,
                "name" => "andi",
                "email" => "andi@gmail.com",
                "phone" => "08123883834848"
            ]
            );
            // $users = User::query();
            return DataTables::of($users)->make();
        }

        return view('user');
    }
}