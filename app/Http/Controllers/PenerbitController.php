<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\penerbitModel;

// php artisan make:controller DosenController

// php artisan make:middleware SessionExpired             app/http/middleware/sessionexpired.php app/http/kernel.php

// composer require barryvdh/laravel-dompdf
class PenerbitController extends Controller
{
    public function __construct(){
        $this->penerbit = new penerbitModel();
    }

    //get page user
    public function index(request $request) 
    {
        $dataPenerbit = array();

        if(Session::has('email'))
		{
            if (request()->ajax()) {
                $nama = $request->input('nama');

                $results = $this->penerbit->getAll($nama);

                $no = 1;
                foreach ($results as $data) {
                        array_push($dataPenerbit, [
                            "no" => $no++,
                            "id" => $data->penerbit_id,
                            "name" => $data->name,
                            "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                            "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                        ]);
                }

                // $users = User::query();
                return DataTables::of($dataPenerbit)->make();
            }

            return view('penerbit', ['title' => 'penerbit']);
		}
		else
		{
			return redirect('/login');
		}
    }

    //create penerbit
	public function create(Request $request)
    {
        $name = $request->input('name');

        // check user exist
        $results = $this->penerbit->checkName($name);

        if(sizeof($results) == 0) {

            $insert = $this->penerbit->create($name);
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
                    "message"    => "Penerbit Gagal Dibuat"
                ];
                echo json_encode($data);
            }
        } else {
            $data = [
                "status"            => false,
                "message"    => "Nama Penerbit Sudah Ada"
            ];
            echo json_encode($data);
        }
    }

    //update penerbit
	public function update(Request $request, $id)
    {
        $name = $request->input('name_edit');

        // check penerbit exist
        $results = $this->penerbit->checkNameExceptId($name, $id);

        if(sizeof($results) == 0) {
            $update = $this->penerbit->updateData($id, $name);
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
                    "message"    => "Data Gagal Diubah"
                ];
                echo json_encode($data);
            }
        } else {
            $data = [
                "status"            => false,
                "message"    => "Penerbit Sudah Ada"
            ];
            echo json_encode($data);
        }
    }

    //delete penerbit
	public function updateStatus(Request $request)
    {
        $id = $request->input('id');

        $query = $this->penerbit->updateStatus($id);
        if($query)
        {
            $data = [
                "status"            => true,
                "message"    => "Data Berhasil Dihapus"
            ];
            echo json_encode($data);
        }
        else
        {
            $data = [
                "status"            => false,
                "message"    => "Data Gagal Dihapus!"
            ];
            echo json_encode($data);
        }
    }
}