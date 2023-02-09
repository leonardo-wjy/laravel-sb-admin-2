<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

// use App\Charts\UserChart;

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
        $this->count_pinjam = new countPinjamModel();
    }

    public function index() 
    {
        if(Session::has('email'))
		{
			$dataCountPinjam = array();

            $dataCountPinjam = $this->count_pinjam->getAll();

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
