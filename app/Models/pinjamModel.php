<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pinjamModel extends Model
{
    public function getAll($user_id, $tgl_awal, $tgl_akhir, $buku, $status)
    {
        // if 2 date inserted
        if($tgl_awal != "" && $tgl_akhir != "")
        {
            return DB::table('pinjam')
            ->select('pinjam.pinjam_id', 'pinjam.book_id', 'pinjam.batas_pengembalian', 'pinjam.status', 'pinjam.createdAt', 'pinjam.updatedAt'
            , 'user.name as peminjam_name', 'penerbit.name as penerbit_name', 'user.email', 'user.phone', 'book.name as book_name')
            ->join('book', 'pinjam.book_id', '=', 'book.book_id')
            ->join('user', 'pinjam.user_id', '=', 'user.user_id')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id')
            ->where('pinjam.book_id','LIKE','%'.$buku.'%')
            ->where('pinjam.user_id','LIKE','%'.$user_id.'%')
            ->where('pinjam.status','LIKE','%'.$status.'%')
            ->whereBetween('pinjam.createdAt',[$tgl_awal, $tgl_akhir])
            ->orderBy('pinjam.batas_pengembalian', 'DESC')
            ->get();
        }
        else
        {
            return DB::table('pinjam')
            ->select('pinjam.pinjam_id', 'pinjam.book_id', 'pinjam.batas_pengembalian', 'pinjam.status', 'pinjam.createdAt', 'pinjam.updatedAt'
            , 'user.name as peminjam_name', 'penerbit.name as penerbit_name', 'user.email', 'user.phone', 'book.name as book_name')
            ->join('book', 'pinjam.book_id', '=', 'book.book_id')
            ->join('user', 'pinjam.user_id', '=', 'user.user_id')
            ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id')
            ->where('pinjam.book_id','LIKE','%'.$buku.'%')
            ->where('pinjam.user_id','LIKE','%'.$user_id.'%')
            ->where('pinjam.status','LIKE','%'.$status.'%')
            ->orderBy('pinjam.batas_pengembalian', 'DESC')
            ->get();
        }
    }

    public function getBelumMengembalikanToday()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        return DB::table('pinjam')
        ->select('pinjam.pinjam_id', 'pinjam.book_id', 'pinjam.batas_pengembalian', 'pinjam.status', 'pinjam.createdAt', 'pinjam.updatedAt'
        , 'user.name as peminjam_name', 'penerbit.name as penerbit_name', 'user.email', 'user.phone', 'book.name as book_name')
        ->join('book', 'pinjam.book_id', '=', 'book.book_id')
        ->join('user', 'pinjam.user_id', '=', 'user.user_id')
        ->join('penerbit', 'book.penerbit_id', '=', 'penerbit.penerbit_id')
        // ->whereBetween('pinjam.batas_pengembalian',[$date . " 00:00:00", $date . " 24:00:00"])
        ->orderBy('pinjam.batas_pengembalian', 'DESC')
        ->get();
    }

    public function create($user_id, $buku, $batas_pengembalian)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());

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
        $date = date('Y-m-d H:i:s', time());

        return DB::table('pinjam')->where('pinjam_id', $id)->update([
            'status' => 3, 
            'updatedAt' => $date
        ]);
    }

    public function getStatusNotActiveByUserId($id)
    {
        return DB::table('pinjam')
        ->where('pinjam.status', 1)
        ->where('user_id', $id)
        ->get();
    }
}