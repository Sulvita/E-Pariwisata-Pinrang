<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Destinasi; 
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DestinasiKebudayaanController extends Controller 
{
    public function create()
    {
        return view('destinasi-kebudayaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'Deskripsi' => 'required|string',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitudepenginapan' => 'nullable|max:255',
            'longitudepenginapan' => 'nullable|max:255',
            'HargaTiket' => 'nullable|numeric',
            'FasilitasDestinasi' => 'nullable|string',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
        ], [
            'nama.required' => 'Pastikan Anda mengisi nama kebudayaan.',
            'Deskripsi.required' => 'Pastikan Anda mengisi Deskripsi kebudayaan.',
            'alamat.required' => 'Pastikan Anda mengisi alamat destinasi.',
            'latitude.required' => 'Pastikan Anda Memilih Lokasi Kebudayaan.',
            'longitude.required' => 'Pastikan Anda Memilih Lokasi Kebudayaan.',
            'gambar.0.image' => 'Pastikan Anda memilih gambar yang sesuai dengan format dan ukuran yang diizinkan.',
            'gambar.0.mimes' => 'Pastikan Anda memilih gambar dengan format: jpeg, png, jpg, gif.',
        ]);

        $nama = $request->input('nama');
        $Deskripsi = $request->input('Deskripsi');
        $alamat = $request->input('alamat');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latitudepenginapan = $request->input('latitudepenginapan');
        $longitudepenginapan = $request->input('longitudepenginapan');
        $hargaTiket = $request->input('HargaTiket');
        $JamBuka = $request->input('JamBuka');
        $fasilitasDestinasi = $request->input('FasilitasDestinasi');

        $kebudayaan = new Destinasi([
            'nama' => $nama,
            'Deskripsi' => $Deskripsi,
            'alamat' => $alamat,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'latitudepenginapan' => $latitudepenginapan,
            'longitudepenginapan' => $longitudepenginapan,
            'HargaTiket' => $hargaTiket,
            'JamBuka' => $JamBuka,
            'FasilitasDestinasi' => $fasilitasDestinasi,
            'kategori' => 'kebudayaan',
        ]);

        if ($request->hasFile('sampul')) {
            $sampulPath = $request->file('sampul')->store('images', 'public');
            $kebudayaan->sampul = $sampulPath;
        }

        if ($request->hasFile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('images', 'public');
                $gambarPaths[] = $path;
            }

            $kebudayaan->gambar = json_encode($gambarPaths);
        }

        if ($kebudayaan->save()) {
            return redirect()
                ->route('destinasi-kebudayaan.index')
                ->with('success', 'Kebudayaan berhasil ditambahkan.');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan kebudayaan.');
        }
    }

    public function show($id)
    {
        $kebudayaan = Destinasi::find($id);

        if (!$kebudayaan) {
            return redirect()
                ->route('kebudayaan.index')
                ->with('error', 'Kebudayaan tidak ditemukan.');
        }
        return view('destinasi-kebudayaan.show', compact('kebudayaan'));
    }

    
    public function index(Request $request)
    {
        $query = Destinasi::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($subquery) use ($search) {
                $subquery->where('nama', 'LIKE', '%' . $search . '%')->orWhere('alamat', 'LIKE', '%' . $search . '%');
            });
            $query->where('kategori', 'kebudayaan');
        } else {
            $query->where('kategori', 'kebudayaan');
        }

        $kebudayaanList = $query->paginate(2); 

         return view('destinasi-kebudayaan.index', ['kebudayaanList' => $kebudayaanList]);
    }

    public function edit($id)
    {
        $kebudayaan = Destinasi::find($id);

        if (!$kebudayaan) {
            return redirect()
                ->route('kebudayaan.index')
                ->with('error', 'Kebudayaan tidak ditemukan.');
        }
        return view('destinasi-kebudayaan.edit', compact('kebudayaan'));
    }

    public function destroy($id)
    {
        $kebudayaan = Destinasi::find($id);

        if (!$kebudayaan) {
            return redirect()
                ->route('destinasi-kebudayaan.index')
                ->with('error', 'Kebudayaan tidak ditemukan.');
        }

        $kebudayaan->delete();

        return redirect()
            ->route('destinasi-kebudayaan.index')
            ->with('success', 'Kebudayaan berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'Deskripsi' => 'required',
            'alamat' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitudepenginapan' => 'nullable|max:255',
            'longitudepenginapan' => 'nullable|max:255',
            'HargaTiket' => 'nullable|numeric',
            'JamBuka' => 'nullable|string',
            'FasilitasDestinasi' => 'nullable|string',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $kebudayaan = Destinasi::find($id);
        $kebudayaan->nama = $request->input('nama');
        $kebudayaan->Deskripsi = $request->input('Deskripsi');
        $kebudayaan->alamat = $request->input('alamat');
        $kebudayaan->HargaTiket = $request->input('HargaTiket');
        $kebudayaan->FasilitasDestinasi = $request->input('FasilitasDestinasi');
        $kebudayaan->longitude = $request->input('longitude');
        $kebudayaan->latitude = $request->input('latitude');
        $kebudayaan->longitudepenginapan = $request->input('longitudepenginapan');
        $kebudayaan->latitudepenginapan = $request->input('latitudepenginapan');
        $kebudayaan->JamBuka = $request->input('JamBuka');

        if ($request->hasFile('sampul')) {
            if ($kebudayaan->sampul) {
                Storage::disk('public')->delete($kebudayaan->sampul);
            }
            $sampulPath = $request->file('sampul')->store('images', 'public');
            $kebudayaan->sampul = $sampulPath;
        }

        if ($request->hasFile('gambar')) {
            if (!empty($kebudayaan->gambar)) {
                $oldImages = json_decode($kebudayaan->gambar, true);
                foreach ($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('images', 'public');
                $gambarPaths[] = $path;
            }
            $kebudayaan->gambar = json_encode($gambarPaths);
        }

        $kebudayaan->save();

        return redirect()
            ->route('destinasi-kebudayaan.index')
            ->with('success', 'Destinasi berhasil diupdate.');
    }
}
