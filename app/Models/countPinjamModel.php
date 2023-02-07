<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class countPinjamModel extends Model
{
    public function getAll()
    {
        return DB::table('count_pinjam')
        ->select('count_pinjam.count', 'count_pinjam.month_year', 'book.name')
        ->join('book', 'count_pinjam.book_id', '=', 'book.book_id')
        ->where('book.status', '!=', 3)
        ->where('count_pinjam.month_year', '2023-01')
        ->orderBy('book.name', 'ASC')
        ->get();
    }
}