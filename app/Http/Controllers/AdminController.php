<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Obat;

class AdminController extends Controller
{
    // ================= DASHBOARD =================

    // Pastikan sudah ada use ini di atas

    public function index()
    {
        $jumlahDokter = Dokter::count();
        $jumlahPasien = Pasien::count();
        $jumlahPoli   = Poli::count();
        $jumlahObat   = Obat::count(); // ✅ Tambahan

        return view('admin.dashboard', compact(
            'jumlahDokter',
            'jumlahPasien',
            'jumlahPoli',
            'jumlahObat' // ✅ Tambahkan ini juga
        ));
    }


    // ================= DOKTER =================

    public function dokterIndex()
    {
        $dokters = Dokter::with(['user', 'poli'])->get();
        $polis = Poli::all();
        $editMode = false;

        return view('admin.dokter', compact('dokters', 'polis', 'editMode'));
    }

    public function dokterStore(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'no_hp'    => 'required|unique:users',
            'password' => 'required|min:6',
            'poli_id'  => 'required|exists:polis,id',
            'alamat'   => 'nullable|string',
        ]);

        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'role'     => 'dokter',
            'alamat'   => $request->alamat,
        ]);

        Dokter::create([
            'user_id' => $user->id,
            'nama'    => $request->nama,
            'poli_id' => $request->poli_id,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function dokterEdit($id)
    {
        $dokters = Dokter::with(['user', 'poli'])->get();
        $dokter = Dokter::with('user')->findOrFail($id);
        $polis = Poli::all();
        $editMode = true;

        return view('admin.dokter', compact('dokters', 'polis', 'dokter', 'editMode'));
    }

    public function dokterUpdate(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $user = $dokter->user;

        $request->validate([
            'nama'     => 'required|string|max:255',
            'poli_id'  => 'required|exists:polis,id',
            'no_hp'    => 'required|unique:users,no_hp,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'alamat'   => 'nullable|string',
        ]);

        $user->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $dokter->update([
            'nama'    => $request->nama,
            'poli_id' => $request->poli_id,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function dokterDestroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $user = $dokter->user;

        $dokter->delete();
        $user->delete();

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil dihapus.');
    }

    // ================= PASIEN =================

    public function pasienIndex()
    {
        $pasiens = Pasien::with('user')->get();
        return view('admin.pasien', compact('pasiens'));
    }

    public function pasienStore(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'required|unique:users,no_hp',
            'password' => 'required|min:6',
            'alamat'   => 'required|string',
            'no_ktp'   => 'required|unique:pasiens,no_ktp',
        ]);

        $bulanTahun = now()->format('Ym');
        $jumlahPasien = Pasien::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        $no_rm = $bulanTahun . '-' . ($jumlahPasien + 1);

        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'role'     => 'pasien',
            'alamat'   => $request->alamat,
        ]);

        Pasien::create([
            'user_id' => $user->id,
            'nama'    => $request->nama,
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'no_rm'   => $no_rm,
            'no_ktp'  => $request->no_ktp,
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function pasienEdit($id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);
        $pasiens = Pasien::with('user')->get();
        return view('admin.pasien_edit', compact('pasien', 'pasiens'));
    }

    public function pasienUpdate(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $user = $pasien->user;

        $request->validate([
            'nama'     => 'required|string|max:255',
            'alamat'   => 'required|string',
            'no_ktp'   => 'required|unique:pasiens,no_ktp,' . $id,
            'no_hp'    => 'required|unique:users,no_hp,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $pasien->update([
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
        ]);

        $user->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function pasienDestroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $user = $pasien->user;

        $pasien->delete();
        $user->delete();

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
