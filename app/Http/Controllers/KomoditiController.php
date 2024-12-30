<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;

class KomoditiController extends Controller
{
    public function index()
    {
        $komoditas = Komoditas::get();
        return view('komoditi.view', ['komoditas' => $komoditas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tanaman' => 'required',
            'kode_warna' => 'required'
        ]);

        Komoditas::create([
            'nama_tanaman' => $request->nama_tanaman,
            'kode_warna' => $request->kode_warna
        ]);

        return back()->with('toast_success', 'Komoditas Berhasil Ditambah!');
    }

    public function update(Request $request)
    {
        $idKomoditas = $request->idKomoditas;
        $komoditas = Komoditas::findOrFail($idKomoditas);

        $request->validate([
            'nama_tanaman' => 'required',
            'kode_warna' => 'required'
        ]);

        $komoditas->update([
            'nama_tanaman' => $request->nama_tanaman,
            'kode_warna' => $request->kode_warna
        ]);

        return back()->with('toast_success', 'Komoditas Berhasil Diupdate!');

    }

    public function destroy($idKomoditas)
    {
        $komoditas = Komoditas::findOrFail($idKomoditas);

        // destroy dusun
        $komoditas->delete();

        return back();
    }
}
