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
            ->select('book.book_id', 'book.penerbit_id', 'book.name', 'book.jumlah', 'book.jumlah_dipinjam', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
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
            ->select('book.book_id', 'book.penerbit_id', 'book.name', 'book.jumlah', 'book.jumlah_dipinjam', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
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
            ->select('book.book_id', 'book.penerbit_id', 'book.name', 'book.jumlah', 'book.jumlah_dipinjam', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
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
            ->select('book.book_id', 'book.penerbit_id', 'book.name', 'book.jumlah', 'book.jumlah_dipinjam', 'book.image', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'book.category_id as category_book_id', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
    }

    public function getById($id)
    {
        return DB::table('book')
		->where('book_id', $id)
        ->where('status', '!=', 3)
        ->first();
    }

    public function create($name, $kategori, $penerbit, $tahun, $file_name, $jumlah)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('book')->insert([
            'name' => $name,
            'category_id' => $kategori,
            'penerbit_id' => $penerbit,
            'tahun_terbit' => $tahun,
            'image' => $file_name,
            'jumlah' => $jumlah,
            'status' => 1,
            'createdAt' => $date,
            'updatedAt' => $date
        ]);
    }

    public function updateData($id, $name, $kategori, $penerbit, $tahun, $file_name, $jumlah)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        if($file_name)
        {
            return DB::table('book')->where('book_id', $id)->update([
                'name' => $name,
                'category_id' => $kategori,
                'penerbit_id' => $penerbit,
                'tahun_terbit' => $tahun,
                'image' => $file_name,
                'jumlah' => $jumlah,
                'status' => 2,
                'updatedAt' => $date
            ]);
        }
        else
        {
            return DB::table('book')->where('book_id', $id)->update([
                'name' => $name,
                'category_id' => $kategori,
                'penerbit_id' => $penerbit,
                'tahun_terbit' => $tahun,
                'jumlah' => $jumlah,
                'status' => 2,
                'updatedAt' => $date
            ]);
        }
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

    public function updateJumlah($id, $jumlah, $jumlah_dipinjam)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('book')->where('book_id', $id)->update([
            'status' => 2,
            'jumlah' => $jumlah,
            'jumlah_dipinjam' => $jumlah_dipinjam,
            'updatedAt' => $date
        ]);
    }

    public function checkFileName($name)
    {
        return DB::table('book')
        ->where('image','LIKE','%'.$name.'%')
        ->get();
    }

    public function getDropdown()
    {
        return DB::table('book')
        ->select('book.book_id as id', 'book.name', 'penerbit.name as penerbit_name', 'book.tahun_terbit')
        ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id')
        ->where('book.status', '!=', 3)
        ->where('book.jumlah', '!=', 0)
        ->orderBy('book.name', 'ASC')
        ->get();
    }
}