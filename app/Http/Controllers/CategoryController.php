<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\categoryModel;

// php artisan make:controller DosenController

// php artisan make:middleware SessionExpired             app/http/middleware/sessionexpired.php app/http/kernel.php

// composer require barryvdh/laravel-dompdf
class CategoryController extends Controller
{
    public function __construct(){
        $this->category = new categoryModel();
    }

    //get page user
    public function index(request $request) 
    {
        $dataCategory = array();

        if(Session::has('email'))
		{
            if (request()->ajax()) {
                $nama = $request->input('nama');

                $results = $this->category->getAll($nama);

                $no = 1;
                foreach ($results as $data) {
                        array_push($dataCategory, [
                            "no" => $no++,
                            "id" => $data->category_id,
                            "name" => $data->name,
                            "description" => $data->description,
                            "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                            "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                        ]);
                }

                // $users = User::query();
                return DataTables::of($dataCategory)->make();
            }

            return view('category', ['title' => 'Category']);
		}
		else
		{
			return redirect('/login');
		}
    }

    //create category
	public function create(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        // check user exist
        $results = $this->category->checkName($name);

        if(sizeof($results) == 0) {

            $insert = $this->category->create($name, $description);
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
                    "message"    => "Kategori Gagal Dibuat"
                ];
                echo json_encode($data);
            }
        } else {
            $data = [
                "status"            => false,
                "message"    => "Nama Kategori Sudah Ada"
            ];
            echo json_encode($data);
        }
    }

    //update category
	public function update(Request $request, $id)
    {
        $name = $request->input('name_edit');
        $description = $request->input('description_edit');

        // check category exist
        $results = $this->category->checkNameExceptId($name, $id);

        if(sizeof($results) == 0) {
            $update = $this->category->updateData($id, $name, $description);
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
                "message"    => "Kategori Sudah Ada"
            ];
            echo json_encode($data);
        }
    }

    //delete category
	public function updateStatus(Request $request)
    {
        $id = $request->input('id');

        $query = $this->category->updateStatus($id);
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