<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\userModel;

// php artisan make:controller DosenController
class UserController extends Controller
{
    public function __construct(){
        $this->user = new userModel();
    }

    public function index() 
    {
        $results = array();
        $dataUser = array();

        if (request()->ajax()) {

            $results = $this->user->getAll();

            $no = 1;
            foreach ($results as $data) {
                array_push($dataUser, [
                    "no" => $no++,
                    "id" => $data->user_id,
                    "name" => $data->name,
                    "email" => $data->email,
                    "phone" => $data->phone,
                    "status" => $data->status,
                    "createdAt" => $data->createdAt,
                    "updatedAt" => $data->updatedAt
                ]);
            }

            // $users = User::query();
            return DataTables::of($dataUser)->make();
        }

        return view('user');
    }
}