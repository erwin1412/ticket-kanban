<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);

        return view('admin.profile.index', compact('user'));
    }

    public function changeProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($request->email == $user->email) {
            $request->validate([
                'name'  => 'required',
                'email' => 'required|email'
            ], [
                'name.required'     => 'Nama harus diisi!',
                'email.required'    => 'Email harus diisi!',
                'email.email'       => 'Email tidak valid!'
            ]);
        } else {
            $request->validate([
                'name'  => 'required',
                'email' => 'required|unique:users|email'
            ], [
                'name.required'     => 'Nama harus diisi!',
                'email.required'    => 'Email harus diisi!',
                'email.unique'      => 'Email sudah terdaftar!',
                'email.email'       => 'Email tidak valid!'
            ]);
        }

        $user->name         = $request->name;
        $user->phone_number = $request->phone_number;
        $user->email        = $request->email;
        $user->save();

        return redirect('/admin/profile')->with('message', 'Profile berhasil diupdate');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password'              => 'required|min:4|confirmed',
            'password_confirmation' => 'required'
        ], [
            'password.required'                 => 'Password harus diisi!',
            'password_confirmation.required'    => 'Konfirmasi password harus diisi!',
            'password.min'                      => 'Password minimal 4 karakter!',
            'password.confirmed'                => 'Konfirmasi password tidak sama!'
        ]);

        $user           = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/profile')->with('message', 'Password berhasil diupdate');
    }
}
