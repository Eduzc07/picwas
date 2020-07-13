<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function showRoot()
    {
        return view('home');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function showLoginCustomer() {
        return view('auth.customers.login');
    }

    public function showRegisterCustomer() {
        return view('auth.customers.register');
    }

    public function showTerms() {
        return view('auth.customers.terms');
    }
}
