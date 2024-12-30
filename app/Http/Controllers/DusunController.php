<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    public function index()
    {
        $dusun = Dusun::get();
        return view('dusun.view', ['dusun' => $dusun]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dusun' => 'required'
        ]);

        Dusun::create([
            'nama_dusun' => $request->nama_dusun
        ]);

        return back()->with('toast_success', 'Nama Dusun Berhasil Ditambah!');
    }

    public function update(Request $request)
    {
        $idDusun = $request->idDusun;
        $dusun = Dusun::findOrFail($idDusun);

        $request->validate([
            'nama_dusun' => 'required'
        ]);

        $dusun->update([
            'nama_dusun' => $request->nama_dusun
        ]);

        return back()->with('toast_success', 'Nama Dusun Berhasil Diupdate!');

    }

    public function destroy($idDusun)
    {
        $dusun = Dusun::findOrFail($idDusun);

        // destroy dusun
        $dusun->delete();

        return back();
    }
}
