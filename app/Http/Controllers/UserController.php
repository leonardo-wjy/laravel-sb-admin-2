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

    //get page user
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
                    "status" => $data->status === 3 ? "NOT ACTIVE" : "ACTIVE",
                    "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                    "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                ]);
            }

            // $users = User::query();
            return DataTables::of($dataUser)->make();
        }

        return view('user');
    }

    //create user
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

    //update user
	public function update(Request $request, $id)
    {
        $name = $request->input('name_edit');
        $email = $request->input('email_edit');
        $phone = $request->input('phone_edit');
        $password = $request->input('passwd_edit');

        // check user exist
        $results = $this->user->checkNameExceptId($name, $id);

        if(sizeof($results) == 0) {
            // check email exist
            $results_email = $this->user->checkEmailExceptId($email, $id);

            if(sizeof($results_email) == 0) {
                $update = $this->user->updateData($id, $name, $email, $phone, $password);
                if($update)
                {
                    $data = [
                        "status"            => true,
                        "message"    => "Data Berhasil Diubah"
                    ];
                    echo json_encode($data);
                }
                else
                {
                    $data = [
                        "status"            => false,
                        "message"    => "Data User Gagal Diubah"
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

    //update status user
	public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $query = $this->user->updateStatus($id, $status);
        if($query)
        {
            $data = [
                "status"            => true,
                "message"    => "Status Berhasil Diubah"
            ];
            echo json_encode($data);
        }
        else
        {
            $data = [
                "status"            => false,
                "message"    => "Status Gagal Diubah"
            ];
            echo json_encode($data);
        }
    }
}