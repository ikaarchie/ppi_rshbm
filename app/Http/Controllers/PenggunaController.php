<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\DataEntry;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\DataDetail;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nomor_induk' => 'required|string|max:255|unique:penggunas,nomor_induk',
            'name' => 'required|string|max:255',
        ]);

        // Simpan data pengguna
        $pengguna = Pengguna::create($validated);

        return redirect()->route('data.form', $pengguna->id);
    }

    public function showDataForm($penggunaId)
    {
        $pengguna = Pengguna::findOrFail($penggunaId);
        return view('data-form', compact('pengguna'));
    }

    public function storeData(Request $request, $penggunaId)
    {
        $pengguna = Pengguna::findOrFail($penggunaId);

        // Validasi data1, data2, dan data3
        $validated = $request->validate([
            'data1' => 'required|string|max:255',
            'data2' => 'required|string|max:255',
            'data3' => 'required|string|max:255',
        ]);

        // Simpan data detail
        DataDetail::create([
            'pengguna_id' => $pengguna->id,
            'data1' => $validated['data1'],
            'data2' => $validated['data2'],
            'data3' => $validated['data3'],
        ]);

        return redirect()->route('data.form', $pengguna->id);
    }
}
