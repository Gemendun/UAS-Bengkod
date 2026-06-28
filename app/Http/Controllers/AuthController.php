<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            if ($role == 'dokter') {
                return redirect()->route('dashboardDokter');
            } elseif ($role == 'pasien') {
                return redirect()->route('dashboardPasien');
            } elseif ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return abort(403, 'Unauthorized action.');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }



    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20|unique:pasiens,no_ktp',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah pasien dengan No KTP sudah ada (redundansi keamanan)
        $existing = \App\Models\Pasien::where('no_ktp', $request->no_ktp)->first();
        if ($existing) {
            return redirect()->back()->withErrors(['no_ktp' => 'Pasien dengan KTP ini sudah terdaftar.'])->withInput();
        }

        // Generate No RM
        $now = Carbon::now();
        $prefix = $now->format('Ym'); // Contoh: 202506
        $countThisMonth = Pasien::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        $urutan = str_pad($countThisMonth + 1, 3, '0', STR_PAD_LEFT); // misal: 001
        $no_rm = $prefix . '-' . $urutan; // contoh: 202506-001

        // 1. Simpan ke tabel users
        $user = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pasien',
        ]);

        // 2. Simpan ke tabel pasiens
        Pasien::create([
            'user_id' => $user->id,
            'no_rm' => $no_rm,
            'nama' => $request->nama,
            'no_ktp' => $request->no_ktp,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
