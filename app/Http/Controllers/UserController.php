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

    //method post
	public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('passwd');

        // check user exist
        $results = $this->user->checkName($name);

        if(sizeof($results) == 0) {
            // check email exist
            $results_email = $this->user->checkEmail($email);

            if(sizeof($results_email) == 0) {
                $insert = $this->user->create($name, $email, $phone, $password);
                if($insert)
                {
                    $data = [
                        "status"            => true,
                        "message"    => "Data Berhasil Disimpan"
                    ];
                    echo json_encode($data);
                }
                else
                {
                    $data = [
                        "status"            => false,
                        "message"    => "User Gagal Dibuat"
                    ];
                    echo json_encode($data);
                }
            } else {
                $data = [
                    "status"            => false,
                    "message"    => "Email Sudah Ada"
                ];
                echo json_encode($data);
            }
        } else {
            $data = [
                "status"            => false,
                "message"    => "User Sudah Ada"
            ];
            echo json_encode($data);
        }
    }
}