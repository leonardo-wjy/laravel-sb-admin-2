<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pinjamModel extends Model
{
    public function getAll()
    {
        return DB::table('pinjam')
        ->select('pinjam.pinjam_id', 'pinjam.book_id', 'pinjam.status', 'pinjam.createdAt', 'pinjam.updatedAt'
        , 'user.name as peminjam_name', 'user.email', 'user.phone', 'book.name as book_name')
        ->join('book', 'pinjam.book_id', '=', 'book.book_id')
        ->join('user', 'pinjam.user_id', '=', 'user.user_id')
        ->orderBy('pinjam.updatedAt', 'DESC')
        ->get();
    }
}