@extends('layouts.main')

@section('container')
    <style>
        .text-indent {
            text-indent: 30px !important;
        }
    </style>

    <div class="main-container container-fluid">

        <div class="page-header">
            <h1 class="page-title">Detail Wisata Alam</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Destinasi Wisata</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12">

                                <div class="card-body h-100">
                                    <div id="carousel-captions1" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">

                                            <div class="carousel-item active">
                                                <img class="d-block w-100 br-5" alt=""
                                                    src="{{ url('storage/' . $destinasiWisata->sampul) }}"
                                                    data-bs-holder-rendered="true">
                                            </div>

                                            @foreach (json_decode($destinasiWisata->gambar) as $imagePath)
                                                <div class="carousel-item">
                                                    <img class="d-block w-100 br-5" alt=""
                                                        src="{{ url('storage/' . $imagePath) }}"
                                                        data-bs-holder-rendered="true">
                                                </div>
                                            @endforeach

                                        </div>

                                        <a class="carousel-control-prev" href="#carousel-captions1" role="button"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>

                                        <a class="carousel-control-next" href="#carousel-captions1" role="button"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>

                                    </div>
                                </div>
                            </div>

                            <div class="details col-xl-12 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title uppercase mx-auto">{{ $destinasiWisata->nama }}</div>
                                    </div>

                                    <div class="card-body">
                                        <div>
                                            <h5>Deskripsi{{-- <i class="fe fe-edit-3 text-primary mx-2"></i> --}}</h5>
                                            <p class="text-justify text-indent">{{ $destinasiWisata->Deskripsi }}</p>
                                            <p class="text-justify text-indent">{{ $destinasiWisata->Sejarah }}</p>
                                        </div>
                                        <hr>


                                        <div class="row">
                                            <div class="col-12 col-lg-12">
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-map-pin fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>Alamat : {{ $destinasiWisata->alamat }}</strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-alert-octagon fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>Dapat Diakses Dengan : {{ $destinasiWisata->akses }} </strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-clock fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>Jam Buka : {{ $destinasiWisata->JamBuka }} </strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-aperture fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>Harga Tiket : Rp. {{ $destinasiWisata->HargaTiket }}
                                                        </strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3 mt-3">
                                                    <div class="me-4 text-center text-primary">
                                                        <span><i class="fe fe-cast fs-20"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong>Fasilitas : {{ $destinasiWisata->FasilitasDestinasi }}
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <div class="">
                                                    <span class="fw-bold me-2">Lokasi :</span>
                                                    <div class="ms-auto">
                                                        <div id="map" style="height: 250px;"></div>
                                                    </div>
                                                    <a href="https://www.google.com/maps?q={{ $destinasiWisata->latitude }},{{ $destinasiWisata->longitude }}"
                                                        target="_blank" class="btn btn-primary block">Buka di Google
                                                        Maps</a>
                                                </div>
                                            </div>
                                            @if (!is_null($destinasiWisata->latitudepenginapan) && !is_null($destinasiWisata->longitudepenginapan))
                                                <div class="col-12 col-lg-6">
                                                    <div class="">
                                                        <span class="fw-bold me-2">Lokasi Penginapan:</span>
                                                        <div class="ms-auto">
                                                            <div id="mapPenginapan" style="height: 250px;"></div>
                                                        </div>

                                                        <a href="https://www.google.com/maps?q={{ $destinasiWisata->latitudepenginapan }},{{ $destinasiWisata->longitudepenginapan }}"
                                                            target="_blank" class="btn btn-primary block">Buka di Google
                                                            Maps</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

        <script>
            var map;

            function initMap() {
                var latitude = {{ $destinasiWisata->latitude }};
                var longitude = {{ $destinasiWisata->longitude }};
                var location = [latitude, longitude];

                map = L.map('map').setView(location, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                L.marker(location).addTo(map)
                    .bindPopup('{{ $destinasiWisata->nama }}').openPopup();
            }

            document.addEventListener('DOMContentLoaded', function() {
                initMap();
            });
        </script>

        <script>
            var mapPenginapan;

            function initMapPenginapan() {
                var latitudePenginapan = {{ $destinasiWisata->latitudepenginapan }};
                var longitudePenginapan = {{ $destinasiWisata->longitudepenginapan }};
                var locationPenginapan = [latitudePenginapan, longitudePenginapan];

                mapPenginapan = L.map('mapPenginapan').setView(locationPenginapan, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapPenginapan);

                L.marker(locationPenginapan).addTo(mapPenginapan)
                    .bindPopup('{{ $destinasiWisata->nama }} (Penginapan)').openPopup();
            }

            document.addEventListener('DOMContentLoaded', function() {
                initMapPenginapan();
            });
        </script>
    @endpush
