<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class AdminObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat', compact('obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat'    => 'required|string|max:50',
            'kemasan'      => 'required|string|max:35',
            'harga'        => 'required|integer|min:0',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:1',
        ]);

        Obat::create($request->only(['nama_obat', 'kemasan', 'harga', 'stok', 'stok_minimum']));

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat_edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat'    => 'required|string|max:50',
            'kemasan'      => 'required|string|max:35',
            'harga'        => 'required|integer|min:0',
            'stok'         => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:1',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->only(['nama_obat', 'kemasan', 'harga', 'stok', 'stok_minimum']));

        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil dihapus.');
    }

    /**
     * Tambah stok obat secara manual
     */
    public function tambahStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->increment('stok', $request->jumlah);

        return redirect()->route('admin.obat.index')
            ->with('success', "Stok {$obat->nama_obat} berhasil ditambah {$request->jumlah} unit. Stok sekarang: {$obat->stok}");
    }

    /**
     * Kurangi stok obat secara manual
     */
    public function kurangiStok(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $obat = Obat::findOrFail($id);

        if ($request->jumlah > $obat->stok) {
            return redirect()->route('admin.obat.index')
                ->with('error', "Gagal! Stok {$obat->nama_obat} hanya tersisa {$obat->stok} unit.");
        }

        $obat->decrement('stok', $request->jumlah);

        return redirect()->route('admin.obat.index')
            ->with('success', "Stok {$obat->nama_obat} berhasil dikurangi {$request->jumlah} unit. Stok sekarang: {$obat->stok}");
    }
}
