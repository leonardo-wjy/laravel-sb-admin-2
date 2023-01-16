<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\bookModel;
use App\Models\categoryModel;

// php artisan make:controller DosenController
class BookController extends Controller
{
    public function __construct(){
        $this->book = new bookModel();
        $this->category = new categoryModel();
    }

    //get page user
    public function index() 
    {
        if(Session::has('email'))
		{
            $results = array();
            $dataBook = array();
            $dataKategoriBuku = array();

            $dataKategoriBuku = $this->category->getDropdown();

            if (request()->ajax()) {

                $results = $this->book->getAll();

                $no = 1;
                foreach ($results as $data) {
                    array_push($dataBook, [
                        "no" => $no++,
                        "id" => $data->book_id,
                        "name" => $data->name,
                        "category_name" => $data->category_name,
                        "penerbit_name" => $data->penerbit_name,
                        "tahun_terbit" => $data->tahun_terbit,
                        "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                        "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                    ]);
                }

                // $users = User::query();
                return DataTables::of($dataBook)->make();
            }

            return view('book', ['title' => 'Book', 'dataKategoriBuku' => $dataKategoriBuku, 'dataPenerbitBuku' => array()]);
		}
		else
		{
			return redirect('/login');
		}
    }
}