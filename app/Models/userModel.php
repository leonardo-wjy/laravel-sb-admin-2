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
        // ->where('status', '!=', 3)
        ->orderBy('updatedAt', 'DESC')
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
            'updatedAt' => '2022-01-13 12:00:00'
        ]);
    }

    public function updateData($id, $name, $email, $phone, $password)
    {
        //check exist password
        if($password)
        {
            return DB::table('user')->where('user_id', $id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone, 
                'password' => $password,
                'updatedAt' => '2022-01-13 12:00:00'
            ]);
        }
        else
        {
            return DB::table('user')->insert([
                'name' => $name,
                'email' => $email,
                'phone' => $phone, 
                'updatedAt' => '2022-01-13 12:00:00'
            ]);
        }
    }

    public function updateStatus($id, $status)
    {
        return DB::table('user')->where('user_id', $id)->update([
            'status' => $status
        ]);
    }

    public function checkName($name)
    {
        return DB::table('user')
        ->where('name', $name)->get();
    }

    public function checkEmail($email)
    {
        return DB::table('user')
        ->where('email', $email)->get();
    }

    public function checkNameExceptId($name, $id)
    {
        return DB::table('user')
        ->where('name', $name)
        ->where('id', '!=', $id)
        ->get();
    }

    public function checkEmailExceptId($email, $id)
    {
        return DB::table('user')
        ->where('email', $email)
        ->where('id', '!=', $id)
        ->get();
    }
}