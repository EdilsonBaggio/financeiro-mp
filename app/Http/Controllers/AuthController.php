<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('vincular-veiculos');
        }
        return back()->withErrors(['email' => 'Os dados estão incorretos ou não existe usuário cadastrado.'])->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken();
        return redirect('/');
    }

}
