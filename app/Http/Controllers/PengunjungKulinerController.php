<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Komentar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class PengunjungKulinerController extends Controller
{
    // public function index()
    // {
    //     $destinasiBuatanList = Destinasi::all();
    //     return view('Buatan.Buatan_list', compact('destinasiBuatanList'));
    // }

    public function index(Request $request)
    {
        $query = Destinasi::query();

        // Check if there is a search query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($subquery) use ($search) {
                $subquery->where('nama', 'LIKE', '%' . $search . '%')->orWhere('alamat', 'LIKE', '%' . $search . '%');
            });

            // Add filter by kategori
            $query->where('kategori', 'buatan');
        } else {
            // Filter by kategori if no search query
            $query->where('kategori', 'buatan');
        }

        // Get paginated results
        $destinasiBuatanList = $query->paginate(2); // Ganti 2 dengan jumlah item per halaman yang diinginkan

        return view('buatan.buatan_list', compact('destinasiBuatanList'));
    }

    public function show(Destinasi $destinasiBuatan)
    {               
        $daftarBuatanTerbaru = Destinasi::where('kategori', 'Buatan')
            ->where('id', '!=', $destinasiBuatan->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Hitung total rating dan rating rata-rata
        $totalRating = $this->totalRating($destinasiBuatan);
        $averageRating = $this->averageRating($destinasiBuatan);
        $comments = $destinasiBuatan->komentars;

        return view('buatan.buatan_detail', compact('destinasiBuatan', 'daftarBuatanTerbaru', 'totalRating', 'averageRating', 'comments'));
    }

    public function totalRating(Destinasi $destinasiBuatan)
    {
        // Menghitung total rating dari komentar-komentar pada destinasi Buatan
        return $destinasiBuatan->komentars()->sum('rating');
    }

    public function averageRating(Destinasi $destinasiBuatan)
    {
        // Menghitung rata-rata rating dari komentar-komentar pada destinasi Buatan
        $totalRating = $this->totalRating($destinasiBuatan);
        $totalKomentar = $destinasiBuatan->komentars()->count();

        if ($totalKomentar > 0) {
            return $totalRating / $totalKomentar;
        } else {
            return 0;
        }
    }

    public function tambahKomentar(Request $request, Destinasi $destinasiBuatan)
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

    // Simpan komentar ke dalam tabel komentars yang berelasi dengan destinasi wisata
    $destinasiBuatan->komentars()->save($komentar);

    // Update nilai rata-rata rating di tabel destinasi_Ku$destinasiBuatan
    $averageRating = $destinasiBuatan->komentars->avg('rating');
    $destinasiBuatan->update([
        'rating' => $averageRating,
    ]);

    return redirect()
        ->back()
        ->with('success', 'Komentar dan rating berhasil ditambahkan.');
}

}
