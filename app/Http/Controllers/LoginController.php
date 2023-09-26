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
            return view('login');
        }
    }

    public function loginaksi(Request $request)
    {   
        $data = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ];
        
        if (Auth::Attempt($data)) 
        {
            return redirect('dashboard');
        }
        else
        {
            Session::flash('error', 'Nama atau Password Salah');
            return redirect('/');
        }
    }

    public function logoutaksi()
    {
        Auth::logout();
        
        return redirect('/');
    }
}