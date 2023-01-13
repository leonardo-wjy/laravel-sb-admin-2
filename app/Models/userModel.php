<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class userModel extends Model
{
    public function getAll()
    {
        return DB::table('user')
        ->where('status', '!=', 3)
        ->get();
    }
}