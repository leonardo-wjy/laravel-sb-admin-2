<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bookModel extends Model
{
    public function getAll($penerbit_id, $nama)
    {
        if($penerbit_id && $nama)
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'book.category_id as category_book_id', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->where('book.penerbit_id', $penerbit_id)
            ->where('book.name','LIKE','%'.$nama.'%')
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
        else if($penerbit_id)
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'book.category_id as category_book_id', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->where('book.penerbit_id', $penerbit_id)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
        else if($nama)
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'book.category_id as category_book_id', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->where('book.name','LIKE','%'.$nama.'%')
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
        else
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'book.category_id as category_book_id', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
    }

    public function create($name, $penerbit, $tahun, $file_name)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('book')->insert([
            'name' => $name,
            'category_id' => '',
            'penerbit_id' => $penerbit,
            'tahun_terbit' => $tahun,
            'image' => $file_name,
            'status' => 1,
            'createdAt' => $date,
            'updatedAt' => $date
        ]);
    }

    public function updateStatus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('book')->where('book_id', $id)->update([
            'status' => 3,
            'updatedAt' => $date
        ]);
    }

    public function checkFileName($name)
    {
        return DB::table('book')
        ->where('image','LIKE','%'.$name.'%')
        ->get();
    }
}