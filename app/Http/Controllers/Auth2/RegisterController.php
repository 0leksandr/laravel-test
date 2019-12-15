<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function get()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function post(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'     => 'required|unique:users',
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:4',
            ]
        );
        $user = new User([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role'     => 'client',
        ]);
        $user->save();
        Auth::login($user);

        return redirect('/');
    }
}
