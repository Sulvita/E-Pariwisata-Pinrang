{{-- @extends('layouts.pengunjung')

@section('container')
    <div class="section bg-landing" id="Blog">
        <div class="container">

            <div class="card">
            
                <div class="card-body pb-4">
                    <form action="{{ route('pengunjung.buatan.index') }}" method="GET">
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
                <h4 class="text-center fw-semibold bok">Postingan Destinasi Wisata Buatan </h4>
                <span class="landing-title"></span>
                <h2 class="text-center fw-semibold mb-7">Destinasi Wisata Buatan.</h2>

                <div class="row">
                    @foreach ($destinasiBuatanList as $destinasiBuatan)
                        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-6">
                            <div class="card"> <a href="{{ route('pengunjung.buatan.show', $destinasiBuatan) }}"><img class="card-img-top"
                                        src="{{ url('storage/' . $destinasiBuatan->sampul) }}"
                                        alt="And this isn't my nose. This is a false one."></a>
                                <div class="card-body d-flex flex-column">
                                    <h3>{{ $destinasiBuatan->nama }}</a></h3>
                                    <small  class="d-block text-muted">{{ \Carbon\Carbon::parse($destinasiBuatan->created_at)->locale('id')->diffForHumans() }}</small>
                                    <div class="text-muted pt-2">{{ $destinasiBuatan->alamat }}</div>
                                    <div class="text-muted pt-2 text-justify">
                                        {{ Str::limit($destinasiBuatan->Deskripsi, 500) }}</div>
                                    <div class="d-flex align-items-center pt-5 mt-auto">
                                        <div class="ms-auto">
                                            <a href="{{ route('pengunjung.buatan.show', $destinasiBuatan) }}" class="btn btn-primary">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $destinasiBuatanList->links('pagination::bootstrap-5') }}
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
</style> --}}



@extends('layouts.pengunjung')

@section('container')
<div class="section bg-landing" id="Blog">
    <div class="container">

        <div class="card">

            <div class="card-body pb-4">
                <form action="{{ route('pengunjung.buatan.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari Destinasi Buatan">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="row">
            <h4 class="text-center fw-semibold bok">Postingan Destinasi Wisata Buatan </h4>
            <span class="landing-title"></span>
            <h2 class="text-center fw-semibold mb-7">Destinasi Wisata Buatan.</h2>

            <div class="row">
                @foreach ($destinasiBuatanList as $destinasiBuatan)
                <div class="col-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ url('storage/' . $destinasiBuatan->sampul) }}" class="img-fluid" alt="img">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $destinasiBuatan->nama }}</h5>
                                    <p class="card-text">{{ Str::limit($destinasiBuatan->Deskripsi, 100) }}</p>
                                    <p class="card-text"><small class="text-muted">{{
                                            \Carbon\Carbon::parse($destinasiBuatan->created_at)->locale('id')->diffForHumans()
                                            }}</small></p>
                                    <a href="{{ route('pengunjung.buatan.show', $destinasiBuatan) }}"
                                        class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{ $destinasiBuatanList->links('pagination::bootstrap-5') }}
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