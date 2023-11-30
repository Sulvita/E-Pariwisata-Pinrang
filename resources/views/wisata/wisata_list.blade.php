@extends('layouts.pengunjung')

@section('container')
    <div class="section bg-landing" id="Blog">
        <div class="container">

            <div class="card">
            
                <div class="card-body pb-4">
                    <form action="{{ route('pengunjung.destinasi.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Cari Destinasi">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            
            </div>

            <div class="row">
                <h4 class="text-center fw-semibold bok">Postingan Destinasi Wisata Alam </h4>
                <span class="landing-title"></span>
                <h2 class="text-center fw-semibold mb-7">Destinasi Wisata Alam.</h2>

                <div class="row">
                    @foreach ($destinasiWisataList as $destinasiWisata)
                    @php
                    $rating = $destinasiWisata->rating;
                    $ratingText = '';
                    
                    if ($rating >= 0 && $rating < 1.5) { $ratingText='Sangat Tidak Direkomendasikan' ; } elseif ($rating>= 1.5 && $rating <
                            2.5) { $ratingText='Tidak Direkomendasikan' ; } elseif ($rating>= 2.5 && $rating < 3.5) {
                                $ratingText='Cukup Direkomendasikan' ; } elseif ($rating>= 3.5 && $rating < 4.5) {
                                    $ratingText='Direkomendasikan' ; } else { $ratingText='Sangat Direkomendasikan' ; } @endphp

                    <div class="col-12 col-md-12 col-xl-12">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ url('storage/' . $destinasiWisata->sampul) }}" class="img-fluid" alt="img">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $destinasiWisata->nama }}</h5>
                                        <p class="card-text">{{ Str::limit($destinasiWisata->Deskripsi, 200) }}</p>
                                        <div class="card-text"><small class="text-muted">Diunggah {{ \Carbon\Carbon::parse($destinasiWisata->created_at)->locale('id')->diffForHumans() }}</small></div>
                                        <div class="card-text mb-4"><small class="text-muted">Dengan Rating {{ number_format($rating, 1) }} ({{ $ratingText }})</small></div>
                                      
                                        <a href="{{ route('pengunjung.destinasi.show', $destinasiWisata) }}" class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    {{ $destinasiWisataList->links('pagination::bootstrap-5') }}
                </div>


            </div>
        </div>
    </div>

@endsection


<style>
    @media screen and (max-width: 992px) {
        .bok {
            margin-top: 40px !important
        }
    }
</style>