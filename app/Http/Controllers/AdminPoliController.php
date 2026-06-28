<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class AdminPoliController extends Controller
{
    /**
     * Menampilkan semua data poli.
     */
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli', compact('polis'));
    }

    /**
     * Menyimpan data poli baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Poli::create($request->only(['nama', 'keterangan']));

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit poli.
     */
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        $polis = Poli::all(); // untuk ditampilkan bersamaan dengan tabel
        $editMode = true;

        return view('admin.poli', compact('poli', 'polis', 'editMode'));
    }

    /**
     * Memperbarui data poli.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->only(['nama', 'keterangan']));

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil diperbarui.');
    }

    /**
     * Menghapus data poli.
     */
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil dihapus.');
    }
}
