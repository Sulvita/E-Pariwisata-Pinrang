<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class PengunjungKebudayaanController extends Controller
{
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

        $destinasikebudayaanList = $query->paginate(2); 

        return view('kebudayaan.kebudayaan_list', compact('destinasikebudayaanList'));
    }

    public function show(Destinasi $destinasikebudayaan)
    {

        $daftarkebudayaanTerbaru = Destinasi::where('kategori', 'Kebudayaan')
            ->where('id', '!=', $destinasikebudayaan->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Hitung total rating dan rating rata-rata
        $totalRating = $this->totalRating($destinasikebudayaan);
        $averageRating = $this->averageRating($destinasikebudayaan);
        $comments = $destinasikebudayaan->komentars;

        return view('kebudayaan.kebudayaan_detail', compact('destinasikebudayaan', 'daftarkebudayaanTerbaru', 'totalRating', 'averageRating', 'comments'));
    }

    public function totalRating(Destinasi $destinasikebudayaan)
    {
        // Menghitung total rating dari komentar-komentar pada destinasi kebudayaan
        return $destinasikebudayaan->komentars()->sum('rating');
    }

    public function averageRating(Destinasi $destinasikebudayaan)
    {
        // Menghitung rata-rata rating dari komentar-komentar pada destinasi kebudayaan
        $totalRating = $this->totalRating($destinasikebudayaan);
        $totalKomentar = $destinasikebudayaan->komentars()->count();

        if ($totalKomentar > 0) {
            return $totalRating / $totalKomentar;
        } else {
            return 0;
        }
    }

    public function tambahKomentar(Request $request, Destinasi $destinasikebudayaan)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Hanya huruf dan spasi yang diperbolehkan
            'isi_komentar' => 'required',
            'rating' => 'required|numeric|min:1|max:5', // Validasi rating antara 1 hingga 5
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat objek Komentar
        $komentar = new Komentar([
            'nama' => $request->input('nama'),
            'isi_komentar' => $request->input('isi_komentar'),
            'rating' => $request->input('rating'),
        ]);

        // Simpan komentar ke dalam tabel komentars yang berelasi dengan destinasi kebudayaan
        $destinasikebudayaan->komentars()->save($komentar);

        // Update nilai rata-rata rating di tabel destinasi_kebudayaan
        $averageRating = $destinasikebudayaan->komentars->avg('rating');
        $destinasikebudayaan->update([
            'rating' => $averageRating,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Komentar dan rating berhasil ditambahkan.');
    }
}
