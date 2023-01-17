<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class categoryModel extends Model
{
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
}