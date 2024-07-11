<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Mendapatkan nama level pengguna
            $userLevel = Auth::user()->level->nama_level;

            // Redirect berdasarkan level pengguna
            if ($userLevel == 'Admin' || $userLevel == 'Kasir' || $userLevel == 'Pimpinan') {
                return redirect()->to('dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'You do not have access to the admin area.',
                ]);
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

