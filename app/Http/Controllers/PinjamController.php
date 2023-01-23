<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\bookModel;
use App\Models\pinjamModel;

// php artisan make:controller DosenController

// php artisan make:middleware SessionExpired             app/http/middleware/sessionexpired.php app/http/kernel.php

// composer require barryvdh/laravel-dompdf
class PinjamController extends Controller
{
    public function __construct(){
        $this->book = new bookModel();
        $this->pinjam = new pinjamModel();
    }

    //get page peminjaman buku
    public function index(request $request) 
    {
        $dataPinjam = array();
        if(Session::has('email'))
		{
            $dataBuku = array();
            $dataBukuAll = array();

            $dataBuku = $this->book->getDropdownAvailableStock();
            $dataBukuAll = $this->book->getDropdown();

            if (request()->ajax()) {
                $tgl_awal = "";
                $tgl_akhir = "";

                if($request->input('tgl_awal'))
                {
                    $tgl_awal = date("Y-m-d", strtotime($request->input('tgl_awal'))) . " 00:00:00";
                }

                if($request->input('tgl_akhir'))
                {
                    $tgl_akhir = date("Y-m-d", strtotime($request->input('tgl_akhir'))) . " 24:00:00";
                }

                $buku = $request->input('buku');
                $status = $request->input('status');

                $results = $this->pinjam->getAll($tgl_awal, $tgl_akhir, $buku, $status);

                $no = 1;
                foreach ($results as $data) {
                        array_push($dataPinjam, [
                            "awal" => $tgl_awal,
                            "akhir" => $tgl_akhir,
                            "no" => $no++,
                            "book_id" => $data->book_id,
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

            return view('pinjam', ['title' => 'peminjaman buku', 'dataBukuAll' => $dataBukuAll, 'dataBuku' => $dataBuku]);
		}
		else
		{
			return redirect('/login');
		}
    }

    //create peminjaman buku
	public function create(Request $request)
    {
        $buku = $request->input('buku');

        $user_id = Session::get('user_id');

        $batas_pengembalian = $request->input('batas_pengembalian');

        // check quote of book
        $results = $this->book->getById($buku);

        if($results)
        {
            //check stock buku not null
            if($results->jumlah !== 0)
            {
                // increase jumlah pinjam and decrease jumlah stok buku
                $update = $this->book->updateJumlah($buku, ($results->jumlah - 1), ($results->jumlah_dipinjam + 1));

                if($update)
                {
                    //create pinjam
                    $insert = $this->pinjam->create($user_id, $buku, $batas_pengembalian);
                    if($insert)
                    {
                        $data = [
                            "status"            => true,
                            "message"    => "Berhasil Pinjam Buku"
                        ];
                        echo json_encode($data);
                    }
                    else
                    {
                        $data = [
                            "status"            => false,
                            "message"    => "Gagal Pinjam Buku"
                        ];
                        echo json_encode($data);
                    }
                }
                else
                {
                    $data = [
                        "status"            => false,
                        "message"    => "Gagal Ubah Data Jumlah Buku"
                    ];
                    echo json_encode($data);
                }
            }
            else
            {
                $data = [
                    "status"            => false,
                    "message"    => "Stok Buku Tidak Mencukupi"
                ];
                echo json_encode($data);
            }
        }
        else
        {
            $data = [
                "status"            => false,
                "message"    => "Buku Tidak Ditemukan"
            ];
            echo json_encode($data);
        }
    }

    //update status peminjman buku
	public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $buku = $request->input('book_id');

        // check quote of book
        $results = $this->book->getById($buku);

        if($results)
        {
            //check stock buku not null
            if($results->jumlah !== 0)
            {
                // increase jumlah pinjam and decrease jumlah stok buku
                $update = $this->book->updateJumlah($buku, ($results->jumlah + 1), ($results->jumlah_dipinjam - 1));

                if($update)
                {
                    //update status peminjaman buku
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
                else
                {
                    $data = [
                        "status"            => false,
                        "message"    => "Gagal Ubah Data Jumlah Buku"
                    ];
                    echo json_encode($data);
                }
            }
            else
            {
                $data = [
                    "status"            => false,
                    "message"    => "Stok Buku Tidak Mencukupi"
                ];
                echo json_encode($data);
            }
        }
        else
        {
            $data = [
                "status"            => false,
                "message"    => "Buku Tidak Ditemukan"
            ];
            echo json_encode($data);
        }
    }
}