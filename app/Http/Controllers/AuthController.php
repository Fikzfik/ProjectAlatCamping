<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginview(): view
    {
        return view('pages.login');
    }
    public function registerview(): view
    {
        return view('pages.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        @dd();
        DB::insert('insert into users (name, email, password, email_verified_at, id_role) values (?, ?, ?, ?, ?)', [
            $request->name,
            $request->email,
            Hash::make($request->password), // Enkripsi password
            null, // email_verified_at bisa null
            $request->id_role, // pastikan id_role tidak null
        ]);

        Auth::login($user);

        return redirect()->intended('home');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Ambil data user berdasarkan email saja, tanpa join dengan tabel `role`
        $validUser = DB::table('users')->where('email', $email)->first();

        if ($validUser) {
            // Periksa apakah password cocok
            if (Hash::check($password, $validUser->password)) {
                // Menggunakan DB::select akan mengembalikan array
                $query = 'SELECT * FROM users WHERE users.email = ?';
                $validUser = DB::select($query, [$email]);

                // Pastikan untuk mengakses elemen pertama dari array
                $user = $validUser[0];

                Auth::loginUsingId($user->id_user);
                return redirect()->intended('/home');
            } else {
                return redirect()->back()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
