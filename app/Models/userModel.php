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

    public function login($email, $password)
    {
        return DB::table('user')
		->where('email', $email)
        ->where('password', $password)
        ->get();
    }

    public function create($name, $email, $phone, $password)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('user')->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone, 
            'password' => md5($password),
            'status' => 1,
            'createdAt' => $date,
            'updatedAt' => $date
        ]);
    }

    public function updateData($id, $name, $email, $phone, $password)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        //check exist password
        if($password)
        {
            return DB::table('user')->where('user_id', $id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone, 
                'password' => md5($password),
                'updatedAt' => $date
            ]);
        }
        else
        {
            return DB::table('user')->where('user_id', $id)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone, 
                'updatedAt' => $date
            ]);
        }
    }

    public function updateStatus($id, $status)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:s', time());

        return DB::table('user')->where('user_id', $id)->update([
            'status' => $status, 
            'updatedAt' => $date
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
        ->where('user_id', '!=', $id)
        ->get();
    }

    public function checkEmailExceptId($email, $id)
    {
        return DB::table('user')
        ->where('email', $email)
        ->where('user_id', '!=', $id)
        ->get();
    }
}