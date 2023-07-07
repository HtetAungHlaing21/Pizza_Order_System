<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login
    public function loginPage(){
        return view ('Auth.login');
    }

    //register
    public function registerPage(){
        return view ('Auth.register');
    }

    //dashboard
    public function dashboard(){
        if (Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#customer');
    }
}
