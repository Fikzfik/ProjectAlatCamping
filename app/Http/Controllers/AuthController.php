<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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

        return redirect()->intended('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            @dd('test');
            return redirect()->intended('home'); // Redirect to the intended page or a specific route
        }
        
        @dd('testt');
        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
