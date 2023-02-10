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
        ->where('count_pinjam.month_year', date('Y-m'))
        ->orderBy('book.name', 'ASC')
        ->get();
    }

    public function getByBookId($buku)
    {
        return DB::table('count_pinjam')
        ->select('count', 'count_pinjam_id')
        ->where('book_id', $buku)
        ->where('month_year', date('Y-m'))
        ->first();
    }

    public function create($buku)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());

        return DB::table('count_pinjam')->insert([
            'book_id' => $buku,
            'count' => 1,
            'month_year' => date('Y-m'),
            'updatedAt' => $date
        ]);
    }

    public function updateData($count, $count_pinjam_id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());

        return DB::table('count_pinjam')->where('count_pinjam_id', $count_pinjam_id)->update([
            'count' => (int)$count + 1,
            'updatedAt' => $date
        ]);
    }
}