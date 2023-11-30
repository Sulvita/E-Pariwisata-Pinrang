@extends('layouts.main')

@section('container')
    <div class="main-container container-fluid">

        <style>
            .sembunyi {
                display: none !important;
            }
        </style>

        <div class="page-header">
            <h1 class="page-title">Tambah Wisata Buatan</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Destinasi Wisata Buatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Wisata Buatan</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('destinasi-buatan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Wisata Buatan</label>
                                        <input type="text" value="" required name="nama" id="nama"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Wisata Buatan</label>
                                        <input type="text" value="" required name="alamat" id="alamat"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Kendaraan Akses</label>
                                        <select name="akses" id="akses" class="form-control">
                                            <option value="">Pilih Akses</option>
                                            <option value="Roda 4">Roda 4</option>
                                            <option value="Roda 2">Roda 2</option>
                                            <option value="Berjalan Kaki">Berjalan Kaki</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="Sejarah">Sejarah Wisata Buatan</label>
                                        <input type="text" value="" required name="Sejarah" id="Sejarah" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="HargaTiket">Harga Tiket</label>
                                        <input type="number" value="" placeholder="2000" required name="HargaTiket"
                                            id="HargaTiket" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="JamBuka">Jam Buka</label>
                                        <input type="time" value="" required name="JamBuka" id="JamBuka"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="Deskripsi">Deskripsi</label>
                                        <textarea name="Deskripsi" required id="Deskripsi" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="FasilitasDestinasi">Fasilitas Wisata Buatan</label>
                                        <textarea type="text" required name="FasilitasDestinasi" id="FasilitasDestinasi" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="sampul">Sampul:</label>
                                        <input type="file" required name="sampul" class="form-control-file"  id="sampul">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="gambar">Gambar</label>
                                        <input type="file" name="gambar[]" required id="gambar" class="form-control-file" multiple>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Pilih Lokasi Wisata Buatan</label>
                                        <label for="map" class="sr-only">Pilih Lokasi</label>
                                        <div id="map" style="height: 400px;"></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Pilih Lokasi Penginapan</label>
                                        <label for="mapPenginapan" class="sr-only">Pilih Lokasi Penginapan</label>
                                        <div id="mapPenginapan" style="height: 400px;"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitude" class="sr-only">Latitude (Titik Koordinat)</label>
                                        <input type="text" required name="latitude" id="latitude" class="form-control"
                                            required readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitude" class="sr-only">Longitude (Titik Koordinat)</label>
                                        <input type="text" required name="longitude" id="longitude"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitudepenginapan" class="sr-only">Latitude Penginapan</label>
                                        <input type="text" required name="latitudepenginapan" id="latitudepenginapan"
                                            class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitudepenginapan" class="sr-only">Longitude Penginapan</label>
                                        <input type="text" required name="longitudepenginapan"
                                            id="longitudepenginapan" class="form-control" required readonly>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    @if ($errors->any())
        <script>
            var errorMessage = "<ul>";
            @foreach ($errors->all() as $error)
                errorMessage += "<li>{{ $error }}</li>";
            @endforeach
            errorMessage += "</ul>";

            Swal.fire({
                title: "Error",
                html: errorMessage,
                icon: "error",
                timer: 15000,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        var map;
        var mapPenginapan;
        var marker;
        var markerPenginapan;

        function initMap() {
            map = L.map('map').setView([-4.3097, 119.9312], 13);
            mapPenginapan = L.map('mapPenginapan').setView([-4.3097, 119.9312], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapPenginapan);

            marker = L.marker([-6.1754, 106.8272], {
                draggable: true
            }).addTo(map);
            markerPenginapan = L.marker([-6.1754, 106.8272], {
                draggable: true
            }).addTo(mapPenginapan);

            map.on('click', function(event) {
                marker.setLatLng(event.latlng);
                fillLatitudeLongitudeInputs(event.latlng.lat, event.latlng.lng);
            });

            mapPenginapan.on('click', function(event) {
                markerPenginapan.setLatLng(event.latlng);
                fillLatitudeLongitudePenginapan(event.latlng.lat, event.latlng.lng);
            });

            document.getElementById('alamat').addEventListener('input', function() {
                var keyword = this.value.trim();
                if (keyword) {
                    geocodeAlamat(keyword);
                } else {
                    // Reset preview map
                    marker.setLatLng([-6.1754, 106.8272]);
                    map.setView([-6.1754, 106.8272], 13);
                    fillLatitudeLongitudeInputs(-6.1754, 106.8272);
                }
            });
        }

        function fillLatitudeLongitudePenginapan(latitude, longitude) {
            document.getElementById('latitudepenginapan').value = latitude.toFixed(6);
            document.getElementById('longitudepenginapan').value = longitude.toFixed(6);
        }

        function fillLatitudeLongitudeInputs(latitude, longitude) {
            document.getElementById('latitude').value = latitude.toFixed(6);
            document.getElementById('longitude').value = longitude.toFixed(6);
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal",
                text: "{{ session('error') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
@endpush
