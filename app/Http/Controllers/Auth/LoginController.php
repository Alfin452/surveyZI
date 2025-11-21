<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Mengarahkan pengguna ke dashboard yang sesuai setelah login.
     * Ini akan menjadi "polisi lalu lintas" kita.
     */
    public function dashboardRedirect()
    {
        $user = Auth::user();

        if (strtolower($user->role?->role_name) === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        }
        if (strtolower($user->role?->role_name) === 'admin') {
            return redirect()->route('unitkerja.admin.dashboard');
        }

        // Jika tidak ada peran admin, anggap sebagai responden dan arahkan ke halaman utama
        return redirect()->route('home');
    }

    /**
     * Menampilkan halaman form login kustom.
     */
    public function showAdminLoginForm()
    {
        return view('auth.login-admin'); 
    }

    /**
     * Menampilkan Halaman Login User (Hanya Tombol Google)
     */
    public function showPublicLoginForm()
    {
        return view('auth.login-public'); 
    }

    /**
     * Menangani proses login manual untuk admin.
     */
    public function login(Request $request)
    {
        // 1. Validasi Input (Username atau Email)
        $request->validate([
            'username' => ['required', 'string'], // Ubah jadi 'username' agar sesuai form
            'password' => ['required', 'string'],
        ]);

        // 2. Tentukan apakah input adalah Email atau Username
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Coba Login
        if (Auth::attempt([$loginType => $request->username, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->dashboardRedirect();
        }

        // 4. Jika Gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Mengarahkan pengguna ke halaman otentikasi Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Mendapatkan informasi pengguna dari Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                // Jika user admin mencoba login via Google, tetap arahkan ke dashboard yang benar
                if (in_array(strtolower($user->role?->role_name), ['superadmin', 'admin'])) {
                    Auth::login($user);
                    return $this->dashboardRedirect();
                }
                $user->update(['google_id' => $googleUser->id]);
            } else {
                $userRole = Role::where('role_name', 'User')->firstOrFail();
                $user = User::create([
                    'username' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)),
                    'role_id' => $userRole->id,
                    'email_verified' => true,
                ]);
            }

            Auth::login($user);
            // Arahkan ke halaman utama untuk responden
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
