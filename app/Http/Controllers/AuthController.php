<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Memproses Pendaftaran User Baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nohp' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nohp' => $request->nohp,
            'role' => 'customer',
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        // Pengalihan halaman otomatis berdasarkan role
        if ($user->role === 'admin') {
            return redirect('/dashboard-admin');
        }

        return redirect('/dashboard-pelanggan');
    }

    // 3. Menampilkan Halaman Login (Jika nanti kamu buat custom login)
    public function showLogin()
    {
        return view('auth.login');
    }

    // 4. Memproses Login User
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Cek role setelah berhasil login
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/dashboard-admin');
            }

            return redirect()->intended('/dashboard-pelanggan');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // 5. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}