<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function loginForm()
    {
        return view('auth.login');
    }

    // Handle login - redirect ke home setelah sukses
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect ke home setelah login sukses
            return redirect()->route('home')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Show register form
    public function registerForm()
    {
        return view('auth.register');
    }

    // Handle registration - redirect ke home setelah sukses
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Auto login setelah register dan redirect ke home
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Akun berhasil dibuat dan Anda sudah login!');
    }

    // Profile page (pengganti dashboard)
    public function profile()
    {
        return view('profile');
    }

    // Logout - redirect ke home
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Anda berhasil logout');
    }
}