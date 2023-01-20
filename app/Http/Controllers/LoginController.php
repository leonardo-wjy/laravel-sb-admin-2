<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Session;

use App\Models\userModel;

// php artisan make:controller DosenController
class LoginController extends Controller
{
    public function __construct(){
        $this->user = new userModel();
    }

    //get page login
    public function index() 
    {
        if(Session::has('email'))
		{
            return redirect('/home');
		}
		else
		{
			return view('login');
		}
    }

    public function login(Request $request)
    {
        $email      = $request->input('email');
        $password   = $request->input('password');

        $results = $this->user->login($email, md5($password));

        if($results) {
            $request->session()->put('user_id', $results->user_id);
            $request->session()->put('email', $email);
            $request->session()->put('name', $results->name);
            $request->session()->put('role', $results->role);

            $data = [
                "status"            => true,
                "message"    => "Login Berhasil"
            ];
            echo json_encode($data);
        } else {
            $data = [
                "status"            => false,
                "message"    => "Login Gagal!"
            ];
            echo json_encode($data);
        }
    }

    public function logout()
    {
       Session::flush();
       return redirect('/login');
    }
}