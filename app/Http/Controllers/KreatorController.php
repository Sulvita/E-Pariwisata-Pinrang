<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;

class KreatorController extends Controller
{
     public function create()
    {
        return view('kreator.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',

                'akses' => 'nullable|string',
                'Sejarah' => 'nullable|string',

                'HargaTiket' => 'nullable|string|max:255',
                'FasilitasDestinasi' => 'nullable|string|max:255',
                'JamBuka' => 'nullable|string|max:255',
                'Deskripsi' => 'nullable|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'latitudepenginapan' => 'nullable|max:255',
                'longitudepenginapan' => 'nullable|max:255',
                'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'gambar' => 'nullable|array',
                'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
                'kategori' => 'required|max:255',
            ],
            [
                'nama.required' => 'Pastikan Anda mengisi nama destinasi.',
                'alamat.required' => 'Pastikan Anda mengisi alamat destinasi.',
                'latitude.required' => 'Pastikan Anda Memilih Lokasi Destinasi.',
                'longitude.required' => 'Pastikan Anda Memilih Lokasi Destinasi.',
                'gambar.0.image' => 'Pastikan Anda Memilih gambar yang sesuai dengan format dan size yang telah ditentukan.',
                'gambar.0.mimes' => 'Pastikan Anda Memilih gambar dengan format: jpeg, png, jpg, gif.',
                'kategori.required' => 'Pastikan Anda Memilih Kategori Destinasi.',
            ],
        );
        
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');

        $akses = $request->input('akses');
        $Sejarah = $request->input('Sejarah');

        $hargaTiket = $request->input('HargaTiket');
        $fasilitasDestinasi = $request->input('FasilitasDestinasi');
        $JamBuka = $request->input('JamBuka');
        $deskripsi = $request->input('Deskripsi');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latitudepenginapan = $request->input('latitudepenginapan');
        $longitudepenginapan = $request->input('longitudepenginapan');
        $kategori = $request->input('kategori');

        $destinasiWisata = new Destinasi([
            'nama' => $nama,
            'alamat' => $alamat,

            'akses' => $akses,
            'Sejarah' => $Sejarah,

            'HargaTiket' => $hargaTiket,
            'FasilitasDestinasi' => $fasilitasDestinasi,
            'JamBuka' => $JamBuka,
            'Deskripsi' => $deskripsi,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'latitudepenginapan' => $latitudepenginapan,
            'longitudepenginapan' => $longitudepenginapan,
            'kategori' => $kategori,
        ]);

        if ($request->hasFile('sampul')) {
            $sampulPath = $request->file('sampul')->store('images', 'public');
            $destinasiWisata->sampul = $sampulPath;
        }

        if ($request->hasFile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('images', 'public');
                $gambarPaths[] = $path;
            }
            $destinasiWisata->gambar = json_encode($gambarPaths);
        }

        if ($destinasiWisata->save()) {
            return redirect()
                ->route('deskripsi.index')
                ->with('success', ' Berhasil Menambahkan Destinasi Baru.');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan wisata alam.');
        }
    }
}
