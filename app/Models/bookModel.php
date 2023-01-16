<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class bookModel extends Model
{
    public function getAll()
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