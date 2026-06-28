<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    // === Dashboard Dokter ===
    public function index()
    {
        $dokterId = Auth::user()->dokter->id;

        $totalSelesai = Periksa::whereHas('jadwal', function ($q) use ($dokterId) {
            $q->where('dokter_id', $dokterId);
        })->where('status', 'selesai')->count();

        $totalBelum = Periksa::whereHas('jadwal', function ($q) use ($dokterId) {
            $q->where('dokter_id', $dokterId);
        })->where('status', '!=', 'selesai')->count();

        return view('dokter.dashboard', compact('totalSelesai', 'totalBelum'));
    }


    // === Tampilkan Daftar Pemeriksaan (untuk dokter yang login) ===
    public function showPeriksa()
    {
        $dokterId = Auth::user()->dokter->id;

        $periksa = Periksa::with(['pasien', 'jadwal.dokter'])
            ->whereHas('jadwal', function ($q) use ($dokterId) {
                $q->where('dokter_id', $dokterId);
            })
            ->latest()
            ->get();

        $obats = Obat::all();

        return view('dokter.periksa', compact('periksa', 'obats'));
    }

    // === Tampilkan Form Edit Pemeriksaan ===
    public function editPeriksa($id)
    {
        $periksa = Periksa::with(['pasien', 'jadwal.dokter'])->findOrFail($id);

        if ($periksa->jadwal->dokter->user_id !== Auth::id()) {
            abort(403);
        }

        $obats = Obat::all();

        return view('dokter.periksaEdit', compact('periksa', 'obats'));
    }

    // === Simpan Update Pemeriksaan ===
    public function updatePeriksa(Request $request, $id)
    {
        $request->validate([
            'catatan_dokter' => 'nullable|string',
            'biaya_periksa' => 'required|integer|min:0',
            'obats' => 'nullable|array',
            'obats.*' => 'exists:obats,id',
        ]);

        $periksa = Periksa::with('jadwal.dokter')->findOrFail($id);

        if ($periksa->jadwal->dokter->user_id !== Auth::id()) {
            abort(403);
        }

        // === Validasi stok obat sebelum disimpan ===
        $obatIds = $request->obats ?? [];
        if (!empty($obatIds)) {
            $obatList = Obat::whereIn('id', $obatIds)->get();

            // Hitung jumlah masing-masing obat yang dipilih
            $jumlahObat = array_count_values($obatIds);

            $stokError = [];
            foreach ($obatList as $obat) {
                $jumlahDiminta = $jumlahObat[$obat->id] ?? 1;
                if ($obat->stok < $jumlahDiminta) {
                    if ($obat->stok <= 0) {
                        $stokError[] = "Stok {$obat->nama_obat} HABIS!";
                    } else {
                        $stokError[] = "Stok {$obat->nama_obat} tidak cukup (tersisa {$obat->stok} unit).";
                    }
                }
            }

            if (!empty($stokError)) {
                return redirect()->back()
                    ->with('error', 'Gagal menyimpan resep: ' . implode(' | ', $stokError))
                    ->withInput();
            }
        }

        // === Simpan data pemeriksaan ===
        $periksa->update([
            'catatan_dokter' => $request->catatan_dokter,
            'biaya_periksa' => $request->biaya_periksa,
            'status' => 'selesai',
        ]);

        // === Otomatis kurangi stok untuk setiap obat yang diresepkan ===
        if (!empty($obatIds)) {
            $jumlahObat = array_count_values($obatIds);
            foreach ($jumlahObat as $obatId => $jumlah) {
                Obat::where('id', $obatId)->decrement('stok', $jumlah);
            }
        }

        $periksa->obats()->sync($obatIds);

        return redirect()->route('periksaDokter')->with('success', 'Pemeriksaan berhasil disimpan dan stok obat telah diperbarui.');
    }

    // === CRUD Obat ===
    public function showObat()
    {
        $obats = Obat::latest()->get();
        return view('dokter.obat', compact('obats'));
    }

    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:69',
            'harga' => 'required|integer',
        ]);

        Obat::create($request->all());
        return redirect()->route('obatDokter');
    }

    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:69',
            'harga' => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());
        return redirect()->route('obatDokter');
    }

    public function deleteObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obatDokter');
    }

    // === Profil Dokter ===
    public function editProfile()
    {
        $dokter = Dokter::with('user')->where('user_id', Auth::id())->firstOrFail();
        $polis = Poli::all();

        return view('dokter.profile', compact('dokter', 'polis'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();
        $user = $dokter->user;

        // Update tabel dokters
        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        // Update tabel users
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('dokter.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }



    // === Riwayat Semua Pasien yang Pernah Diperiksa oleh Dokter ===


    public function riwayatPasien()
    {
        $dokterUserId = Auth::id();

        $riwayat = Periksa::with(['pasien', 'jadwal.dokter']) // wajib include 'pasien'
            ->where('status', 'selesai')
            ->whereHas('jadwal.dokter', function ($q) use ($dokterUserId) {
                $q->where('user_id', $dokterUserId);
            })
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('dokter.riwayat', compact('riwayat'));
    }



    // === Detail Riwayat Pasien: Hanya yang Diperiksa oleh Dokter yang Login ===
    public function riwayatPasienDetail($idPasien)
    {
        $dokterId = Auth::user()->dokter->id;

        $riwayat = Periksa::with(['pasien', 'jadwal.dokter.user', 'obats'])
            ->where('id_pasien', $idPasien)
            ->whereHas('jadwal', function ($q) use ($dokterId) {
                $q->where('dokter_id', $dokterId);
            })
            ->orderByDesc('tgl_periksa')
            ->get();

        $namaPasien = optional($riwayat->first()->pasien)->nama ?? 'Pasien';
        $totalKunjungan = $riwayat->count();


        return view('dokter.riwayatDetail', compact('riwayat', 'namaPasien', 'totalKunjungan'));
    }
}
