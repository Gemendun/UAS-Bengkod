<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PasienController extends Controller
{
    /**
     * Tampilkan dashboard untuk pasien
     */
    public function index()
    {
        $userId = Auth::id();

        // Hitung total riwayat periksa pasien
        $totalRiwayat = Periksa::where('id_pasien', $userId)
            ->where('status', 'selesai')
            ->count();

        // Hitung jumlah dokter unik yang pernah memeriksa
        $dokterUnik = Periksa::with('jadwal')
            ->where('id_pasien', $userId)
            ->where('status', 'selesai')
            ->get()
            ->pluck('jadwal.dokter_id')
            ->unique()
            ->count();

        return view('pasien.dashboard', compact('totalRiwayat', 'dokterUnik'));
    }

    /**
     * Tampilkan form daftar poli dan riwayat periksa pasien
     */
    public function showPeriksa()
    {
        $jadwalDokters = JadwalPeriksa::with(['dokter.user', 'dokter.poli'])
            ->where('is_aktif', true)
            ->get();

        $periksa = Periksa::with(['jadwal.dokter.user', 'jadwal.dokter.poli'])
            ->where('id_pasien', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('pasien.periksa', compact('jadwalDokters', 'periksa'));
    }

    /**
     * Detail pemeriksaan untuk pasien
     */
    public function showDetail($id)
    {
        $periksa = Periksa::with(['jadwal.dokter.user', 'jadwal.dokter.poli'])
            ->where('id_pasien', Auth::id())
            ->findOrFail($id);

        return view('pasien.detail_periksa', compact('periksa'));
    }

    /**
     * Simpan pendaftaran pemeriksaan baru oleh pasien
     */
    public function storePeriksa(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'nullable|string|max:255',
        ]);

        $jadwal = JadwalPeriksa::findOrFail($request->id_jadwal);
        $today = Carbon::now()->format('Y-m-d');

        // Cek apakah pasien sudah mendaftar pada jadwal & hari yang sama
        $sudahDaftar = Periksa::where('id_pasien', Auth::id())
            ->where('id_jadwal', $jadwal->id)
            ->whereDate('tgl_periksa', $today)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->withErrors(['Anda sudah mendaftar di jadwal ini hari ini.']);
        }

        // Nomor antrian
        $antrian = Periksa::whereDate('tgl_periksa', $today)
            ->where('id_jadwal', $jadwal->id)
            ->count() + 1;

        Periksa::create([
            'id_jadwal' => $jadwal->id,
            'id_pasien' => Auth::id(),
            'tgl_periksa' => Carbon::now(),
            'keluhan' => $request->keluhan, // ← pakai keluhan di sini
            'biaya_periksa' => 0,
            'nomor_antrian' => $antrian,
            'status' => 'menunggu',
        ]);

        return redirect()->route('periksaPasien')->with('success', 'Berhasil mendaftar! Nomor Antrian Anda: ' . $antrian);
    }
}
