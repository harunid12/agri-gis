<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Lahan;
use App\Models\Komoditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LahanController extends Controller
{
    public function index()
    {
        $lahan = DB::table('lahan')
        ->join('dusun', 'lahan.id_dusun', '=', 'dusun.id_dusun')
        ->join('komoditas', 'lahan.id_komoditas', '=', 'komoditas.id_komoditas')
        ->select(
            'lahan.id_lahan',
            'lahan.alamat_lahan',
            'lahan.luas_lahan',
            DB::raw('ST_AsText(lahan.koordinat_poligon) as koordinat_poligon'),  // Menggunakan ST_AsText untuk poligon
            'lahan.id_dusun',
            'lahan.id_komoditas',
            'dusun.nama_dusun AS nama_dusun',
            'komoditas.nama_tanaman AS nama_tanaman'
        )
        ->get();

        // Proses koordinat untuk memisahkannya per baris
        $lahan->each(function ($item) {
            // Menghapus 'POLYGON((' dan '))'
            $coordinates = str_replace(['POLYGON((', '))'], '', $item->koordinat_poligon);

            // Memisahkan koordinat berdasarkan koma dan newline
            $coordinatesArray = explode(',', $coordinates);

            // Mengubah koordinat menjadi format yang terpisah per baris
            $formattedCoordinates = implode("\n", $coordinatesArray);

            $item->koordinat_poligon = $formattedCoordinates;
        });

        $dusun = Dusun::get();
        $komoditas = Komoditas::get();
        return view('lahan.view', compact('lahan', 'dusun', 'komoditas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'koordinat_poligon' => 'required',
            'id_dusun' => 'required',
            'id_komoditas' => 'required',
            'alamat_lahan' => 'required|max:255',
            'luas_lahan' => 'required',
        ]);

        $rawKoordinat = $request->input('koordinat_poligon'); 
        $lines = explode("\n", trim($rawKoordinat)); 
        $polygonPoints = [];

        foreach ($lines as $line) {
            $coords = explode(',', trim($line)); 
            if (count($coords) == 2) {
                $lat = trim($coords[0]);
                $lng = trim($coords[1]);
                $polygonPoints[] = "$lng $lat"; 
            }
        }

        $polygonString = 'POLYGON((' . implode(',', $polygonPoints) . '))';

        Lahan::create([
            'koordinat_poligon' => DB::raw("ST_GeomFromText('$polygonString')"),
            'id_dusun' => $request->id_dusun,
            'id_komoditas' => $request->id_komoditas,
            'alamat_lahan' => $request->alamat_lahan,
            'luas_lahan' => $request->luas_lahan,
        ]);

        return back()->with('toast_success', 'Lahan Berhasil Ditambah!');
    }

    public function update(Request $request)
    {
        $lahan = Lahan::findOrFail($request->idLahan);
        // dd($request->all());
        $request->validate([
            'koordinat_poligon' => 'required',
            'id_dusun' => 'required',
            'id_komoditas' => 'required',
            'alamat_lahan' => 'required|max:255',
            'luas_lahan' => 'required',
        ]);

        $rawKoordinat = $request->input('koordinat_poligon'); 
        $lines = explode("\n", trim($rawKoordinat)); 
        $polygonPoints = [];

        foreach ($lines as $line) {
            $coords = explode(' ', trim($line)); 
            if (count($coords) == 2) {
                $lng = trim($coords[0]);
                $lat = trim($coords[1]);
                $polygonPoints[] = "$lng $lat"; 
            }
        }

        // Pastikan poligon tertutup
        if (!empty($polygonPoints) && $polygonPoints[0] !== end($polygonPoints)) {
            $polygonPoints[] = $polygonPoints[0];
        }

        $polygonString = 'POLYGON((' . implode(',', $polygonPoints) . '))';

        try {
            $lahan->update([
                'koordinat_poligon' => DB::raw("ST_GeomFromText('$polygonString')"),
                'id_dusun' => $request->id_dusun,
                'id_komoditas' => $request->id_komoditas,
                'alamat_lahan' => $request->alamat_lahan,
                'luas_lahan' => $request->luas_lahan,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update: ' . $e->getMessage()]);
        }

        return back()->with('toast_success', 'Lahan Berhasil Diubah!');
    }


    public function destroy($idLahan)
    {
        $lahan = Lahan::findOrFail($idLahan);

        // destroy dusun
        $lahan->delete();

        return back();
    }
}
