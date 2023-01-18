<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class categoryModel extends Model
{
    public function getAll($nama)
    {
        if($nama)
        {
            return DB::table('category')
            ->where('status', '!=', 3)
            ->where('name','LIKE','%'.$nama.'%')
            ->orderBy('updatedAt', 'DESC')
            ->get();
        }
        else
        {
            return DB::table('category')
            ->where('status', '!=', 3)
            ->orderBy('updatedAt', 'DESC')
            ->get();
        }
    }

    public function getDropdown()
    {
        return DB::table('category')
        ->select('category_id as id', 'name as value')
        ->where('status', '!=', 3)
        ->orderBy('name', 'ASC')
        ->get();
    }

    public function getNameById($id)
    {
        return DB::table('category')
        ->where('category_id', $id)
        ->where('status', '!=', 3)
        ->orderBy('name', 'ASC')
        ->first();
    }

    public function updateStatus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('category')->where('category_id', $id)->update([
            'status' => 3,
            'updatedAt' => $date
        ]);
    }
}