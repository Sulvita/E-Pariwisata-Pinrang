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

class DestinasiWisataController extends Controller
{
    public function create()
    {
        return view('destinasi_wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
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
            ],
            [
                'nama.required' => 'Pastikan Anda mengisi nama destinasi.',
                'alamat.required' => 'Pastikan Anda mengisi alamat destinasi.',
                'latitude.required' => 'Pastikan Anda Memilih Lokasi Destinasi.',
                'longitude.required' => 'Pastikan Anda Memilih Lokasi Destinasi.',
                'gambar.0.image' => 'Pastikan Anda Memilih gambar yang sesuai dengan format dan size yang telah ditentukan.',
                'gambar.0.mimes' => 'Pastikan Anda Memilih gambar dengan format: jpeg, png, jpg, gif.',
            ],
        );
        
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $hargaTiket = $request->input('HargaTiket');
        $fasilitasDestinasi = $request->input('FasilitasDestinasi');
        $JamBuka = $request->input('JamBuka');
        $deskripsi = $request->input('Deskripsi');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latitudepenginapan = $request->input('latitudepenginapan');
        $longitudepenginapan = $request->input('longitudepenginapan');

        $destinasiWisata = new Destinasi([
            'nama' => $nama,
            'alamat' => $alamat,
            'HargaTiket' => $hargaTiket,
            'FasilitasDestinasi' => $fasilitasDestinasi,
            'JamBuka' => $JamBuka,
            'Deskripsi' => $deskripsi,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'latitudepenginapan' => $latitudepenginapan,
            'longitudepenginapan' => $longitudepenginapan,
            'kategori' => 'wisata',
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
                ->route('destinasi-wisata.index')
                ->with('success', ' wisata alam ditambahkan.');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan wisata alam.');
        }
    }

    public function show($id)
    {
        $destinasiWisata = Destinasi::find($id);

        if (!$destinasiWisata) {
            return redirect()
                ->route('destinasi-wisata.index')
                ->with('error', 'Destinasi wisata tidak ditemukan.');
        }

        return view('destinasi_wisata.show', compact('destinasiWisata'));
    }

    public function index(Request $request)
    {
        $query = Destinasi::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($subquery) use ($search) {
                $subquery->where('nama', 'LIKE', '%' . $search . '%')->orWhere('alamat', 'LIKE', '%' . $search . '%');
            });
            $query->where('kategori', 'wisata');
        } else {
            $query->where('kategori', 'wisata');
        }

        $destinasiWisataList = $query->paginate(2);

        return view('destinasi_wisata.index', ['destinasiWisataList' => $destinasiWisataList]);
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
        $destinasiWisata = Destinasi::find($id);

        if (!$destinasiWisata) {
            return redirect()
                ->route('destinasi-wisata.index')
                ->with('error', 'Destinasi wisata tidak ditemukan.');
        }

        return view('destinasi_wisata.edit', compact('destinasiWisata'));
    }

    public function destroy($id)
    {
        $destinasiWisata = Destinasi::find($id);

        if (!$destinasiWisata) {
            return redirect()
                ->route('destinasi-wisata.index')
                ->with('error', 'Destinasi wisata tidak ditemukan.');
        }

        $destinasiWisata->delete();

        return redirect()
            ->route('destinasi-wisata.index')
            ->with('success', 'Destinasi wisata berhasil dihapus.');
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
            'HargaTiket' => 'nullable|numeric',
            'FasilitasDestinasi' => 'nullable|string',
            'JamBuka' => 'nullable|string',
            'Deskripsi' => 'nullable|string',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $destination = Destinasi::find($id);
        $destination->nama = $request->input('nama');
        $destination->alamat = $request->input('alamat');
        $destination->latitude = $request->input('latitude');
        $destination->longitude = $request->input('longitude');
        $destination->HargaTiket = $request->input('HargaTiket');
        $destination->FasilitasDestinasi = $request->input('FasilitasDestinasi');
        $destination->JamBuka = $request->input('JamBuka');
        $destination->Deskripsi = $request->input('Deskripsi');
        $destination->latitudepenginapan = $request->input('latitudepenginapan');
        $destination->longitudepenginapan = $request->input('longitudepenginapan');

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
            ->route('destinasi-wisata.index')
            ->with('success', 'Wisata Alam berhasil diupdate.');
    }
}
