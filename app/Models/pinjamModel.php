<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pinjamModel extends Model
{
    public function getAll($buku, $status)
    {
        return DB::table('pinjam')
        ->select('pinjam.pinjam_id', 'pinjam.book_id', 'pinjam.batas_pengembalian', 'pinjam.status', 'pinjam.createdAt', 'pinjam.updatedAt'
        , 'user.name as peminjam_name', 'penerbit.name as penerbit_name', 'user.email', 'user.phone', 'book.name as book_name')
        ->join('book', 'pinjam.book_id', '=', 'book.book_id')
        ->join('user', 'pinjam.user_id', '=', 'user.user_id')
        ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id')
        ->where('pinjam.book_id','LIKE','%'.$buku.'%')
        ->where('pinjam.status','LIKE','%'.$status.'%')
        ->orderBy('pinjam.batas_pengembalian', 'DESC')
        ->get();
    }

    public function create($user_id, $buku, $batas_pengembalian)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('pinjam')->insert([
            'user_id' => $user_id,
            'book_id' => $buku,
            'batas_pengembalian' => $batas_pengembalian,
            'status' => 1,
            'createdAt' => $date,
            'updatedAt' => ''
        ]);
    }

    public function updateStatus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('pinjam')->where('pinjam_id', $id)->update([
            'status' => 3, 
            'updatedAt' => $date
        ]);
    }
}