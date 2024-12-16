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
use Illuminate\Support\Facades\Log;

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
        // Log semua request input
        Log::info('Register Request:', $request->all());

        // Validasi input request
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Insert data user ke database
        DB::insert('insert into users (name, email, password, email_verified_at, id_role) values (?, ?, ?, ?, ?)', [
            'user', // Default name
            $request->email,
            Hash::make($request->password), // Enkripsi password
            null, // email_verified_at bisa null
            2, // Default id_role
        ]);

        // Ambil data user yang baru saja dibuat
        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();

        // Log user registration success
        Log::info('User registered successfully:', [
            'name' => $user->name,
            'email' => $user->email,
            'id_role' => $user->id_role,
        ]);

        // Login user yang baru saja dibuat
        Auth::loginUsingId($user->id_user);

        // Log user login success
        Log::info('User logged in successfully:', [
            'email' => $user->email,
        ]);

        // Redirect ke halaman home
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
        // Logging untuk debug request
        Log::info('Logout request:', $request->all());

        // Melakukan logout user
        Auth::logout();

        // Menghapus semua session data
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}
