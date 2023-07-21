<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'     => [
                'required',
                'email'
            ],
            'password'  => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email / Password Anda salah!'
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'phone_number'          => 'required',
            'email'                 => 'required|unique:users',
            'password'              => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ], [
            'name.required'                     => 'Nama harus diisi',
            'phone_number.required'             => 'No HP harus diisi',
            'email.required'                    => 'Email harus diisi',
            'email.unique'                      => 'Email sudah terdaftar',
            'password.required'                 => 'Password harus diisi',
            'password.min'                      => 'Password minimal 5 karakter',
            'password.confirmed'                => 'Konfirmasi password harus sama',
            'password_confirmation.required'    => 'Konfirmasi password harus diisi'
        ]);

        $user               = new User();
        $user->name         = $request->name;
        $user->phone_number = $request->phone_number;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->save();

        return redirect('/login')->with('success', 'Akun berhasil dibuat');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
