<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Models\DeskripsiKabupaten;
use App\Models\Destinasi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class RootController extends Controller
{
    public function index()
    {
        $data = DeskripsiKabupaten::all();
        $topRatedDestinations = Destinasi::with('komentars')
            ->withAvg('komentars', 'rating')
            ->orderByDesc('komentars_avg_rating')
            ->limit(4)
            ->get();

        return view('welcome', compact('data', 'topRatedDestinations'));
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('search'); 
        $posts = Destinasi::where('nama', 'like', '%' . $keyword . '%')
            ->orWhere('alamat', 'like', '%' . $keyword . '%')
            ->orWhere('HargaTiket', 'like', '%' . $keyword . '%')
            ->orWhere('FasilitasDestinasi', 'like', '%' . $keyword . '%')
            ->orWhere('JamBuka', 'like', '%' . $keyword . '%')
            ->orWhere('Deskripsi', 'like', '%' . $keyword . '%')
            ->orWhere('Sejarah', 'like', '%' . $keyword . '%')
            ->orWhere('MenuKuliner', 'like', '%' . $keyword . '%')
            ->orWhere('kategori', 'like', '%' . $keyword . '%')
            ->get();
        $noResults = $posts->isEmpty(); 

        return view('postingan.semua-postingan', compact('posts', 'keyword', 'noResults'));
    }

    public function show(Destinasi $destination)
    {
        return view('postingan.detail', compact('destination'));
    }

   public function showAllPosts()
{
    $posts = Destinasi::orderBy('rating', 'desc')->get();

    return view('postingan.semua-postingan', compact('posts'));
}


    
    public function tambahKomentar(Request $request, Destinasi $destination)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/'], 
            'isi_komentar' => 'required',
            'rating' => 'required|numeric|min:1|max:5', 
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $komentar = new Komentar([
            'nama' => $request->input('nama'),
            'isi_komentar' => $request->input('isi_komentar'),
            'rating' => $request->input('rating'),
        ]);

        $destination->komentars()->save($komentar);

        $averageRating = $destination->komentars->avg('rating');
        $destination->update([
            'rating' => $averageRating,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Komentar dan rating berhasil ditambahkan.');
    }
}
