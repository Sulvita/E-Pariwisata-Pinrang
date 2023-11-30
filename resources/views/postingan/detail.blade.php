@extends('layouts.pengunjung')

@section('container')


<style>
    /* Button no. 1 - Akan tampil di atas 768px */
    @media (min-width: 769px) {
        .button-1 {
            display: block !important;
        }
    }

    /* Button no. 1 - Akan disembunyikan di bawah 769px */
    @media (max-width: 768px) {
        .button-1 {
            display: none !important;
        }
    }

    /* Button no. 2 - Akan tampil di bawah 769px */
    @media (max-width: 768px) {
        .button-2 {
            display: block !important;
        }
    }

    /* Button no. 2 - Akan disembunyikan di atas 768px */
    @media (min-width: 769px) {
        .button-2 {
            display: none !important;
        }
    }
</style>

<div class="container">
    <div class="row">

        <div class="col-12 col-md-7">
            <div class="card mt-6">
                <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img class="d-block w-100 br-5" alt="" src="{{ asset('storage/' . $destination->sampul) }}"
                                data-bs-holder-rendered="true">
                        </div>
                        @if ($destination->gambar)
                        @foreach (json_decode($destination->gambar) as $image)
                        <div class="carousel-item ">
                            <img class="d-block w-100 br-5" alt="" src="{{ asset('storage/' . $image) }}"
                                data-bs-holder-rendered="true">
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-body">
                    <div class="d-md-flex">

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-clock fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $destination->created_at->diffForHumans() }}
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-calendar fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $destination->created_at->translatedFormat('l d F Y') }}
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-star fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                Rating: {{ number_format($destination->averageRating(), 2) }}
                            </div>
                        </a>

                        <div class="ms-auto">
                            <a href="javascript:void(0);" class="d-flex mb-2">
                                <i
                                    class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                <div class=" mt-3 ms-1 text-muted font-weight-semibold">{{
                                    $destination->totalKomentar()
                                    }} Komentar</div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <h3 class="text-center"> {{ $destination->nama }}</a></h3>
                            <p class="text-justify"> {{ $destination->Deskripsi }}</p>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="d-flex align-items-center mb-3 mt-3">
                                    <div class="me-4 text-center text-primary">
                                        <span><i class="fe fe-map-pin fs-20"></i></span>
                                    </div>
                                    <div>
                                        <strong>Alamat : <br> {{ $destination->alamat }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="d-flex align-items-center mb-3 mt-3">
                                    <div class="me-4 text-center text-primary">
                                        <span><i class="fe fe-clock fs-20"></i></span>
                                    </div>
                                    <div>
                                        <strong>Jam Buka : <br> {{ $destination->JamBuka }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="d-flex align-items-center mb-3 mt-3">
                                    <div class="me-4 text-center text-primary">
                                        <span><i class="fe fe-aperture fs-20"></i></span>
                                    </div>
                                    <div>
                                        <strong>Harga Tiket : <br> Rp.{{ $destination->HargaTiket }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="d-flex align-items-center mb-3 mt-3">
                                    <div class="me-4 text-center text-primary">
                                        <span><i class="fe fe-cast fs-20"></i></span>
                                    </div>
                                    <div>
                                        <strong>Fasilitas : <br> {{ $destination->FasilitasDestinasi }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 col-lg-6">
                                <div class="">
                                    <span class="fw-bold me-2">Lokasi Destinasi Alam</span>
                                    <div class="ms-auto">
                                        <div id="map" style="height: 250px;"></div>
                                    </div>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}"
                                        target="_blank" class="button-1 btn-sm mt-2 btn btn-primary block">Buka di
                                        Google Maps Browser</a>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}"
                                        target="_blank" class="button-2 btn-sm mt-2 btn block btn-primary">Buka di
                                        Aplikasi Google Maps Yang Terinstall</a>
                                </div>
                            </div>
                            @if (!is_null($destination->latitudepenginapan) &&
                            !is_null($destination->longitudepenginapan))
                            <div class="col-12 col-lg-6">
                                <div class="">
                                    <span class="fw-bold me-2">Lokasi Penginapan Terdekat :</span>
                                    <div id="mappenginapan" style="height: 250px;"></div>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitudepenginapan }},{{ $destination->longitudepenginapan }}"
                                        target="_blank" class="button-1 btn-sm mt-2 btn btn-primary block">Buka di
                                        Google Maps Browser</a>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitudepenginapan }},{{ $destination->longitudepenginapan }}"
                                        target="_blank" class="button-2 btn-sm mt-2 btn block btn-primary">Buka di
                                        Aplikasi Google Maps Yang
                                        Terinstall</a>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-5 mt-6">

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <Table>Tambahkan Komentar</Table>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('destination.tambah-komentar', $destination) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="isi_komentar">Komentar</label>
                            <textarea class="form-control" id="isi_komentar" name="isi_komentar" rows="5"
                                placeholder="Isi komentar" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select class="form-control" id="rating" name="rating" required>
                                <option value="">Pilih rating</option>
                                <option value="1">1 - Sangat Tidak Direkomendasikan</option>
                                <option value="2">2 - Tidak Direkomendasikan</option>
                                <option value="3">3 - Cukup Direkomendasikan</option>
                                <option value="4">4 - Direkomendasikan</option>
                                <option value="5">5 - Sangat Direkomendasikan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Tambah Komentar dan Rating</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Commentar</div>
                </div>

                @foreach ($destination->komentars as $komentar)
                <div class="card-body pb-0">
                    <div class="media mb-1 overflow-visible d-block d-sm-flex">

                        <div class="media-body overflow-visible">
                            <div class="border mb-5 p-4 br-5">
                                <h5 class="mt-0">{{ $komentar->nama }}</h5>
                                <span><i class="fe fe-thumb-up text-danger"></i></span>
                                <p class="font-13 text-muted">{{ $komentar->isi_komentar }}</p>
                                <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                    {{ $komentar->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>
    var mappenginapan;
    
    function initMappenginapan() {
        var latitudepenginapan = {{ $destination->latitudepenginapan }};
        var longitudepenginapan = {{ $destination->longitudepenginapan }};
        var locationpenginapan = [latitudepenginapan, longitudepenginapan];
    
        mappenginapan = L.map('mappenginapan').setView(locationpenginapan, 13);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mappenginapan);
    
        L.marker(locationpenginapan).addTo(mappenginapan)
            .bindPopup('{{ $destination->nama }}').openPopup();
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        initMappenginapan();
    });
</script>

<script>
    var map;
    
    function initMap() {
        var latitude = {{ $destination->latitude }};
        var longitude = {{ $destination->longitude }};
        var location = [latitude, longitude];
    
        map = L.map('map').setView(location, 13);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
        L.marker(location).addTo(map)
            .bindPopup('{{ $destination->nama }}').openPopup();
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

@endsection