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