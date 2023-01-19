<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\pinjamModel;

// php artisan make:controller DosenController

// php artisan make:middleware SessionExpired             app/http/middleware/sessionexpired.php app/http/kernel.php

// composer require barryvdh/laravel-dompdf
class PinjamController extends Controller
{
    public function __construct(){
        $this->pinjam = new pinjamModel();
    }

    //get page user
    public function index(request $request) 
    {
        $dataPinjam = array();
        if(Session::has('email'))
		{
            if (request()->ajax()) {
                $results = $this->pinjam->getAll();

                $no = 1;
                foreach ($results as $data) {
                        array_push($dataPinjam, [
                            "no" => $no++,
                            "id" => $data->pinjam_id,
                            "batas_pengembalian" => $data->batas_pengembalian ? date("d/m/Y", strtotime($data->batas_pengembalian)) : "-",
                            "penerbit_name" => $data->penerbit_name,
                            "peminjam_name" => $data->peminjam_name,
                            "email" => $data->email,
                            "phone" => $data->phone,
                            "name" => $data->book_name,
                            "status" => $data->status,
                            "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                            "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                        ]);
                }

                // $users = User::query();
                return DataTables::of($dataPinjam)->make();
            }

            return view('pinjam', ['title' => 'peminjaman buku']);
		}
		else
		{
			return redirect('/login');
		}
    }

    //update status peminjman buku
	public function updateStatus(Request $request)
    {
        $id = $request->input('id');

        $query = $this->pinjam->updateStatus($id);
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