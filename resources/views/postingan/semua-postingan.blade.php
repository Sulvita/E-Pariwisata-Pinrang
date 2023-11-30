@extends('layouts.pengunjung')

@section('container')


    <div class="section bg-landing" id="Blog">
        <div class="container">

            <div class="card">

                <div class="card-body pb-4">
                    <form action="{{ route('cari.postingan') }}" method="GET">
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
                <h4 class="text-center fw-semibold bok">Semua Postingan </h4>
                <span class="landing-title"></span>


                <h2 class="text-center fw-semibold mb-7">Semua Destinasi</h2>

                <div class="row">
                    @foreach ($posts as $post)

                    @php
                    $rating = $post->rating;
                    $ratingText = '';
                    
                    if ($rating >= 0 && $rating < 1.5) { $ratingText='Sangat Tidak Direkomendasikan' ; } elseif ($rating>= 1.5 && $rating <
                            2.5) { $ratingText='Tidak Direkomendasikan' ; } elseif ($rating>= 2.5 && $rating < 3.5) {
                                $ratingText='Cukup Direkomendasikan' ; } elseif ($rating>= 3.5 && $rating < 4.5) {
                                    $ratingText='Direkomendasikan' ; } else { $ratingText='Sangat Direkomendasikan' ; } @endphp



                            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-4">
                                <div class="card"> <a href="{{ route('destination.show', ['destination' => $post->id]) }}"><img
                                            class="card-img-top" src="{{ url('storage/' . $post->sampul) }}"
                                            alt="And this isn't my nose. This is a false one."></a>
                                    <div class="card-body d-flex flex-column">
                                        <h3>{{ $post->nama }}</a></h3>
                                        <small
                                            class="d-block text-muted">Di Unggah {{ \Carbon\Carbon::parse($post->created_at)->locale('id')->diffForHumans() }}</small>
                                            <div class="text-muted"><small>Dengan Rating {{ number_format($rating, 1) }} ({{ $ratingText }})</small></div>
                                        <div class="text-muted"><small>{{ $post->alamat }}</small> </div>
                                        <div class="text-muted pt-2 text-justify">
                                            {{ Str::limit($post->Deskripsi, 100) }}</div>
                                        <div class="d-flex align-items-center pt-5 mt-auto">
                                            <div class="ms-auto">
                                                <a href="{{ route('destination.show', ['destination' => $post->id]) }}"
                                                    class="btn btn-primary">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    {{-- @endif --}}
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
