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
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
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
            'role' => 'customer', // Default pendaftar baru adalah customer
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);
        $request->session()->regenerate();

        // Alihkan halaman berdasarkan role
        return $this->redirectByRole($user);
    }

    // 3. Menampilkan Halaman Login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
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

            // PERBAIKAN: Menggunakan fungsi pengalihan role yang aman
            return $this->redirectByRole(Auth::user());
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

        return redirect()->route('login');
    }

    // 💡 Fungsi Tambahan: Menghindari Hardcode URL agar tidak 404 lagi
    private function redirectByRole($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('pages.dashboard'); // Mengarah ke /admin/dashboard
        }
        
        return redirect()->route('customer.katalog'); // Mengarah ke /katalog
    }
}