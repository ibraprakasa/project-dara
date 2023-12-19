<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) 
        {
            return redirect('dashboard');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function loginaksi(Request $request)
    {   

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        
        if (Auth::Attempt($data)) 
        {
            Session(['email' => $request->input('email')]);
            return redirect('dashboard');
        }
        else
        {
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/login');
        }
    }

    public function logoutaksi()
    {
        Auth::logout();
                
        return redirect('/login');
    }
}