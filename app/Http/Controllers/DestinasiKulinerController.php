<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Destinasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class DestinasiKulinerController extends Controller
{
    public function create()
    {
        return view('destinasi_buatan.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'JamBuka' => 'nullable|string|max:255',
                'Deskripsi' => 'nullable|string',
                'HargaTiket' => 'nullable|numeric',
                'FasilitasDestinasi' => 'nullable|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'latitudepenginapan' => 'nullable|max:255',
                'longitudepenginapan' => 'nullable|max:255',
                'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'gambar' => 'nullable|array',
                'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
               
            ],
            [
                'nama.required' => 'Pastikan Anda mengisi nama destinasi buatan.',
                'alamat.required' => 'Pastikan Anda mengisi alamat destinasi buatan.',
                'latitude.required' => 'Pastikan Anda Memilih Lokasi Destinasi buatan.',
                'longitude.required' => 'Pastikan Anda Memilih Lokasi Destinasi buatan.',
                'gambar.0.image' => 'Pastikan Anda Memilih gambar yang sesuai dengan format dan size yang telah ditentukan.',
                'gambar.0.mimes' => 'Pastikan Anda Memilih gambar dengan format: jpeg, png, jpg, gif.',
            ],
        );

        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $JamBuka = $request->input('JamBuka');
        $deskripsi = $request->input('Deskripsi');
        $HargaTiket = $request->input('HargaTiket');
        $fasilitasDestinasi = $request->input('FasilitasDestinasi');
        $JamBuka = $request->input('JamBuka');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latitudepenginapan = $request->input('latitudepenginapan');
        $longitudepenginapan = $request->input('longitudepenginapan');

        $destinasiBuatan = new Destinasi([
            'nama' => $nama,
            'alamat' => $alamat,
            'JamBuka' => $JamBuka,
            'Deskripsi' => $deskripsi,
            'FasilitasDestinasi' => $fasilitasDestinasi,
            'JamBuka' => $JamBuka,
            'HargaTiket' => $HargaTiket,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'latitudepenginapan' => $latitudepenginapan,
            'longitudepenginapan' => $longitudepenginapan,
            'kategori' => 'buatan',
        ]);

        if ($request->hasFile('sampul')) {
            $sampulPath = $request->file('sampul')->store('images', 'public');
            $destinasiBuatan->sampul = $sampulPath;
        }

        if ($request->hasFile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('images', 'public');
                $gambarPaths[] = $path;
            }

            $destinasiBuatan->gambar = json_encode($gambarPaths);
        }

        if ($destinasiBuatan->save()) {
            return redirect()
                ->route('destinasi-buatan.index')
                ->with('success', 'Destinasi buatan berhasil ditambahkan.');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan destinasi buatan.');
        }
    }

    public function show($id)
    {
        $destinasiBuatan = Destinasi::find($id);

        if (!$destinasiBuatan) {
            return redirect()
                ->route('destinasi-buatan.index')
                ->with('error', 'Destinasi buatan tidak ditemukan.');
        }

        return view('destinasi_buatan.show', compact('destinasiBuatan'));
    }

   
    public function index(Request $request)
    {
        $query = Destinasi::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($subquery) use ($search) {
                $subquery->where('nama', 'LIKE', '%' . $search . '%')->orWhere('alamat', 'LIKE', '%' . $search . '%');
            });

            $query->where('kategori', 'buatan');
        } else {
            $query->where('kategori', 'buatan');
        }

        $destinasiBuatanList = $query->paginate(2); 

        return view('destinasi_buatan.index', ['destinasiBuatanList' => $destinasiBuatanList]);
    }

    private function geocodeAlamat($alamat)
    {
        $url = 'https://nominatim.openstreetmap.org/search?q=' . urlencode($alamat) . '&format=json';

        try {
            $response = Http::timeout(10)->get($url, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0',
                ],
            ]);

            $data = $response->json();

            if (is_array($data) && count($data) > 0) {
                return $data[0];
            }

            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function edit($id)
    {
        $destinasiBuatan = Destinasi::find($id);

        if (!$destinasiBuatan) {
            return redirect()
                ->route('destinasi-buatan.index')
                ->with('error', 'Destinasi buatan tidak ditemukan.');
        }

        return view('destinasi_buatan.edit', compact('destinasiBuatan'));
    }

    public function destroy($id)
    {
        $destinasiBuatan = Destinasi::find($id);

        if (!$destinasiBuatan) {
            return redirect()
                ->route('destinasi-buatan.index')
                ->with('error', 'Destinasi buatan tidak ditemukan.');
        }

        $destinasiBuatan->delete();

        return redirect()
            ->route('destinasi-buatan.index')
            ->with('success', 'Destinasi buatan berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'latitudepenginapan' => 'nullable|max:255',
            'longitudepenginapan' => 'nullable|max:255',
            'JamBuka' => 'nullable|string',
            'Deskripsi' => 'nullable|string',
            'HargaTiket' => 'nullable|numeric',
            'FasilitasDestinasi' => 'nullable|string',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $destination = Destinasi::find($id);

        $destination->nama = $request->input('nama');
        $destination->alamat = $request->input('alamat');
        $destination->latitude = $request->input('latitude');
        $destination->longitude = $request->input('longitude');
        $destination->latitudepenginapan = $request->input('latitudepenginapan');
        $destination->longitudepenginapan = $request->input('longitudepenginapan');
        $destination->HargaTiket = $request->input('HargaTiket');
        $destination->FasilitasDestinasi = $request->input('FasilitasDestinasi');
        $destination->JamBuka = $request->input('JamBuka');
        $destination->Deskripsi = $request->input('Deskripsi');

        if ($request->hasFile('sampul')) {
            if ($destination->sampul) {
                Storage::disk('public')->delete($destination->sampul);
            }

            $sampulPath = $request->file('sampul')->store('images', 'public');
            $destination->sampul = $sampulPath;
        }

        if ($request->hasFile('gambar')) {
            if (!empty($destination->gambar)) {
                $oldImages = json_decode($destination->gambar, true);
                foreach ($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $gambarPaths = [];
            foreach ($request->file('gambar') as $image) {
                $path = $image->store('images', 'public');
                $gambarPaths[] = $path;
            }
            $destination->gambar = json_encode($gambarPaths);
        }

        $destination->save();

        return redirect()
            ->route('destinasi-buatan.index')
            ->with('success', 'Destinasi buatan berhasil diupdate.');
    }
}
