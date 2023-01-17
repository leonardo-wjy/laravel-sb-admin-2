<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\bookModel;
use App\Models\categoryModel;
use App\Models\penerbitModel;

// php artisan make:controller DosenController
class BookController extends Controller
{
    public function __construct(){
        $this->book = new bookModel();
        $this->category = new categoryModel();
        $this->penerbit = new penerbitModel();
    }

    //get page user
    public function index(Request $request) 
    {
        if(Session::has('email'))
		{
            $results = array();
            $dataBook = array();
            $dataKategoriBuku = array();
            $dataPenerbitBuku = array();

            $dataKategoriBuku = $this->category->getDropdown();
            $dataPenerbitBuku = $this->penerbit->getDropdown();

            if (request()->ajax()) {
                $category_id = $request->input('kategori');
                $penerbit_id = $request->input('penerbit');
                $nama = $request->input('nama');

                $results = $this->book->getAll($penerbit_id, $nama);

                $no = 1;
                foreach ($results as $data) {
                    $myNewArray = array();
                    if($data->category_book_id)
                    {
                        $myNewArray = explode(',', $data->category_book_id);
                    }
                    $arrCategoryName = array();

                    //check category id inserted 
                    if($category_id)
                    {
                        foreach ($myNewArray as $category_value) {
                            $result_category = $this->category->getNameById($category_value);
                            if($result_category)
                            {
                                array_push($arrCategoryName, $result_category->name); 
                            }
                        }
                        if(in_array($category_id, $myNewArray))
                        {
                            array_push($dataBook, [
                                "no" => $no++,
                                "id" => $data->book_id,
                                "name" => $data->name,
                                "image" => $data->image ? "cover/".$data->image : "",
                                "category_name" =>$arrCategoryName,
                                "penerbit_name" => $data->penerbit_name,
                                "tahun_terbit" => $data->tahun_terbit,
                                "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                                "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                            ]);
                        }
                    }
                    else
                    {
                        foreach ($myNewArray as $category_value) {
                            $result_category = $this->category->getNameById($category_value);
                            if($result_category)
                            {
                                array_push($arrCategoryName, $result_category->name); 
                            }
                        }

                        array_push($dataBook, [
                            "no" => $no++,
                            "id" => $data->book_id,
                            "name" => $data->name,
                            "image" => $data->image ? "cover/".$data->image : "",
                            "category_name" =>$arrCategoryName,
                            "penerbit_name" => $data->penerbit_name,
                            "tahun_terbit" => $data->tahun_terbit,
                            "createdAt" => $data->createdAt ? date("d/m/Y", strtotime($data->createdAt)) : "-",
                            "updatedAt" => $data->updatedAt ? date("d/m/Y", strtotime($data->updatedAt)) : "-"
                        ]);
                    }
                }

                // $users = User::query();
                return DataTables::of($dataBook)->make();
            }

            return view('book', ['title' => 'Book', 'dataKategoriBuku' => $dataKategoriBuku, 'dataPenerbitBuku' => $dataPenerbitBuku]);
		}
		else
		{
			return redirect('/login');
		}
    }

    //create book
	public function create(Request $request)
    {
        $name = $request->input('name');
        $kategori =implode(",", $request->input('kategori'));
        $penerbit = $request->input('penerbit');
        $tahun = $request->input('tahun');
        $image = $request->file('image');

        // // nama file
		// echo 'File Name: '.$file->getClientOriginalName();
		// echo '<br>';
 
      	// // ekstensi file
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		// echo '<br>';
 
      	// // real path
		// echo 'File Real Path: '.$file->getRealPath();
		// echo '<br>';
 
      	// // ukuran file
		// echo 'File Size: '.$file->getSize();
		// echo '<br>';
 
      	// // tipe mime
		// echo 'File Mime Type: '.$file->getMimeType();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'cover';

        $name_file = "";

        if($image)
        {
            $name_file = $image->getClientOriginalName();

            // check user exist
            $results = $this->book->checkFileName($name_file);

            if(sizeof($results) != 0) 
            {
                $name_file = sizeof($results) + 1 .'-'. $image->getClientOriginalName();
            } 
        }

        $insert = $this->book->create($name, $kategori, $penerbit, $tahun, $name_file);
        if($insert)
        {
            if($image)
            {
                // upload file
		        $image->move($tujuan_upload, $name_file);
            }

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
                "message"    => "Data Gagal Disimpan!"
            ];
            echo json_encode($data);
        }
    }

    //delete book
	public function updateStatus(Request $request)
    {
        $id = $request->input('id');

        $query = $this->book->updateStatus($id);
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