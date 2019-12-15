<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function get()
    {
        return view('auth.login');
    }

    public function post(Request $request)
    {
        if (Auth::attempt([
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ])) {
            return redirect('/');
        }
        return view('auth.login', ['error' => 'Invalid credentials']);
    }
}
