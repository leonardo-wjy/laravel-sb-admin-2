<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class penerbitModel extends Model
{
    public function getAll($nama)
    {
        if($nama)
        {
            return DB::table('penerbit')
            ->where('status', '!=', 3)
            ->where('name','LIKE','%'.$nama.'%')
            ->orderBy('updatedAt', 'DESC')
            ->get();
        }
        else
        {
            return DB::table('penerbit')
            ->where('status', '!=', 3)
            ->orderBy('updatedAt', 'DESC')
            ->get();
        }
    }

    public function getDropdown()
    {
        return DB::table('penerbit')
        ->select('penerbit_id as id', 'name as value')
        ->where('status', '!=', 3)
        ->orderBy('name', 'ASC')
        ->get();
    }

    public function getNameById($id)
    {
        return DB::table('penerbit')
        ->where('penerbit_id', $id)
        ->where('status', '!=', 3)
        ->orderBy('name', 'ASC')
        ->first();
    }

    public function create($name)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());

        return DB::table('penerbit')->insert([
            'name' => $name,
            'status' => 1,
            'createdAt' => $date,
            'updatedAt' => $date
        ]);
    }

    public function updateData($id, $name)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());

        return DB::table('penerbit')->where('penerbit_id', $id)->update([
            'name' => $name,
            'status' => 2,
            'updatedAt' => $date
        ]);
    }

    public function updateStatus($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s', time());

        return DB::table('penerbit')->where('penerbit_id', $id)->update([
            'status' => 3,
            'updatedAt' => $date
        ]);
    }

    public function checkName($name)
    {
        return DB::table('penerbit')
        ->where('name', $name)->get();
    }

    public function checkNameExceptId($name, $id)
    {
        return DB::table('penerbit')
        ->where('name', $name)
        ->where('penerbit_id', '!=', $id)
        ->get();
    }
}