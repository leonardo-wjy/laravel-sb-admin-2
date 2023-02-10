<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

// use App\Charts\UserChart;

use App\Models\pinjamModel;
use App\Models\countPinjamModel;

// php artisan make:controller DosenController
//composer create-project laravel/laravel laravel-datatable
//composer require yajra/laravel-datatables-oracle
//composer require yajra/laravel-datatables-buttons

//composer require consoletvs/charts
//php artisan vendor:publish --tag=charts_config

class HomeController extends Controller
{
	public function __construct(){
		$this->pinjam = new pinjamModel();
        $this->count_pinjam = new countPinjamModel();
    }

    public function index() 
    {
        if(Session::has('email'))
		{
			$dataCountPinjam = array();

            $dataCountPinjam = $this->count_pinjam->getAll();

			if (request()->ajax()) {
				$dataPinjam = array();
                $results = $this->pinjam->getBelumMengembalikanToday();

                $no = 1;
                foreach ($results as $data) {
                        array_push($dataPinjam, [
                            "no" => $no++,
                            "batas_pengembalian" => $data->batas_pengembalian ? date("d/m/Y", strtotime($data->batas_pengembalian)) : "-",
                            "penerbit_name" => $data->penerbit_name,
                            "peminjam_name" => $data->peminjam_name,
                            "email" => $data->email,
                            "phone" => $data->phone,
                            "name" => $data->book_name,
                            "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-"
                        ]);
                }

                // $users = User::query();
                return DataTables::of($dataPinjam)->make();
            }

			// $usersChart = new UserChart;
			// $usersChart->labels(['Jan', 'Feb', 'Mar']);
			// $usersChart->dataset('Users by trimester', 'line', [10, 25, 13]);

            return view('home', ['title' => 'Home', 'count' => $dataCountPinjam]);
		}
		else
		{
			return redirect('/login');
		}
    }
}
