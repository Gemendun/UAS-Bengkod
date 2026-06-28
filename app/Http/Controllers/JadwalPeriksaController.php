<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('dokter_id', Auth::user()->dokter->id)->get();
        return view('dokter.jadwal', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $dokterId = Auth::user()->dokter->id;

        $exists = JadwalPeriksa::where('dokter_id', $dokterId)
            ->where('hari', $request->hari)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })->exists();

        if ($exists) {
            return back()->withErrors(['Jadwal bentrok dengan jadwal lain.']);
        }

        if ($request->has('is_aktif')) {
            JadwalPeriksa::where('dokter_id', $dokterId)->update(['is_aktif' => false]);
        }

        JadwalPeriksa::create([
            'dokter_id' => $dokterId,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'is_aktif' => $request->has('is_aktif'),
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        if ($jadwal->dokter_id !== Auth::user()->dokter->id) {
            abort(403);
        }

        if (strtolower($jadwal->hari) == strtolower(now()->translatedFormat('l'))) {
            return back()->withErrors(['Tidak dapat mengedit jadwal pada hari H.']);
        }

        return view('dokter.jadwalEdit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        if ($jadwal->dokter_id !== Auth::user()->dokter->id) {
            abort(403);
        }

        if (strtolower($jadwal->hari) == strtolower(now()->translatedFormat('l'))) {
            return back()->withErrors(['Tidak dapat mengedit jadwal pada hari H.']);
        }

        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $dokterId = $jadwal->dokter_id;

        $exists = JadwalPeriksa::where('dokter_id', $dokterId)
            ->where('hari', $request->hari)
            ->where('id', '!=', $jadwal->id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })->exists();

        if ($exists) {
            return back()->withErrors(['Jadwal bentrok dengan jadwal lain.']);
        }

        if ($request->has('is_aktif')) {
            JadwalPeriksa::where('dokter_id', $dokterId)->update(['is_aktif' => false]);
        }

        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'is_aktif' => $request->has('is_aktif'),
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function aktifkan($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        if ($jadwal->dokter_id != Auth::user()->dokter->id) {
            abort(403);
        }

        JadwalPeriksa::where('dokter_id', $jadwal->dokter_id)->update(['is_aktif' => false]);

        $jadwal->is_aktif = true;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diaktifkan.');
    }
}
