<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bookModel extends Model
{
    public function getAll($category_id, $penerbit_id)
    {
        if($category_id && $penerbit_id)
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'category.name as category_name', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->where('book.category_id', $category_id)
            ->where('book.penerbit_id', $penerbit_id)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
        else if($category_id)
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'category.name as category_name', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->where('book.category_id', $category_id)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
        else if($penerbit_id)
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'category.name as category_name', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->where('book.penerbit_id', $penerbit_id)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
        else
        {
            return DB::table('book')
            ->select('book.book_id', 'book.name', 'book.tahun_terbit', 'book.createdAt', 'book.updatedAt', 'book.status'
            , 'category.name as category_name', 'penerbit.name as penerbit_name')
            ->join('category', 'book.category_id', '=', 'category.category_id', 'left outer')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id', 'right outer')
            ->where('book.status', '!=', 3)
            ->orderBy('book.updatedAt', 'DESC')
            ->get();
        }
    }
}