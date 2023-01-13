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

    public function create($name, $email, $phone, $password)
    {
        return DB::table('user')->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone, 
            'password' => $password,
            'status' => 1,
            'createdAt' => '2022-01-13 12:00:00',
            'updatedAt' => ''
        ]);
    }

    public function checkName($name)
    {
        return DB::table('user')
        ->where('name', $name)->get();
    }
}