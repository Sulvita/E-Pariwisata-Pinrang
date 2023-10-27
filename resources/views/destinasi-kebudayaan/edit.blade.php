{{-- 
@extends('layouts.main')

@section('container')

    <style>
        .sembunyi {
            display: none !important;
        }
    </style>

    <div class="main-container container-fluid">

        <div class="page-header">
            <h1 class="page-title">Edit kebudayaan </h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">kebudayaan </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit kebudayaan </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">

                <div class="card">

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('destinasi-kebudayaan.update', ['id' => $kebudayaan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama kebudayaan </label>
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            value="{{ $kebudayaan->nama }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat kebudayaan </label>
                                        <input type="text" name="alamat" id="alamat" class="form-control"
                                            value="{{ $kebudayaan->alamat }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitudePenginapan">Latitude Penginapan</label>
                                        <input type="text" name="latitudepenginapan" id="latitudepenginapan"
                                            class="form-control" value="{{ $kebudayaan->latitudepenginapan }}" readonly
                                            required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitudePenginapan">Longitude Penginapan</label>
                                        <input type="text" name="longitudepenginapan" id="longitudepenginapan"
                                            class="form-control" readonly value="{{ $kebudayaan->longitudepenginapan }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control"
                                            value="{{ $kebudayaan->latitude }}" readonly required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" readonly
                                            value="{{ $kebudayaan->longitude }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitudePenginapan">Latitude Penginapan</label>
                                        <input type="text" name="latitudepenginapan" id="latitudepenginapan" class="form-control"
                                            value="{{ $kebudayaan->latitudepenginapan }}" readonly required>
                                        <div id="latitudePenginapanPreview">{{ $kebudayaan->latitudepenginapan }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitudePenginapan">Longitude Penginapan</label>
                                        <input type="text" name="longitudepenginapan" id="longitudepenginapan" class="form-control" readonly
                                            value="{{ $kebudayaan->longitudepenginapan }}" required>
                                        <div id="longitudePenginapanPreview">{{ $kebudayaan->longitudepenginapan }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control" readonly
                                            value="{{ $kebudayaan->latitude }}" required>
                                        <div id="latitudePreview">{{ $kebudayaan->latitude }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" readonly
                                            value="{{ $kebudayaan->longitude }}" required>
                                        <div id="longitudePreview">{{ $kebudayaan->longitude }}</div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="HargaTiket">Harga Tiket</label>
                                        <input type="text" name="HargaTiket" placeholder="2000" id="HargaTiket"
                                            class="form-control" value="{{ $kebudayaan->HargaTiket }}">
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="JamBuka">Jam Buka</label>
                                        <input type="text" name="JamBuka" id="JamBuka" class="form-control"
                                            value="{{ $kebudayaan->JamBuka }}">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="FasilitasDestinasi">Fasilitas Destinasi kebudayaan </label>
                                        <textarea type="text" name="FasilitasDestinasi" id="FasilitasDestinasi" class="form-control" value=""> {{ $kebudayaan->FasilitasDestinasi }} </textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="Deskripsi">Deskripsi Destinasi kebudayaan </label>
                                        <textarea name="Deskripsi" id="Deskripsi" class="form-control">{{ $kebudayaan->Deskripsi }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="sampul">Sampul Baru</label>
                                        <input type="file" name="sampul" id="sampul" class="form-control-file">
                                        <small class="form-text text-muted">Unggah gambar sampul baru (jpeg, png, jpg,
                                            gif)</small>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="sampul_lama">Sampul Lama</label>
                                        @if ($kebudayaan->sampul)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $kebudayaan->sampul) }}"
                                                    alt="Sampul Lama" class="img-fluid" style="max-height: 200px;">
                                            </div>
                                        @else
                                            <p>Tidak ada sampul lama.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="gambar">Gambar Baru</label>
                                        <input type="file" name="gambar[]" id="gambar" class="form-control-file"
                                            multiple>
                                        <small class="form-text text-muted">Unggah gambar baru (jpeg, png, jpg,
                                            gif)</small>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="gambar_lama">Gambar Lama</label>
                                        @if ($kebudayaan->gambar)
                                            <div class="row">
                                                @foreach (json_decode($kebudayaan->gambar) as $imagePath)
                                                    <div class="col-xs-6 col-sm-4 col-md-4 col-xl-3 mb-5 border-bottom-0">
                                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="Gambar Lama"
                                                            class="img-fluid" style="max-height: 200px;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>Tidak ada gambar lama.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="map">Lokasi </label>
                                        <div id="map" style="height: 400px;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mapPenginapan">Peta Penginapan</label>
                                        <div id="mapPenginapan" style="height: 400px;"></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Update Destinasi
                                        kebudayaan</button>
                                </div>

                            </div>
                        </form>

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

        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

        <script>
            function fillLatitudeLongitudepenginapanInputs(latitude, longitude) {
            document.getElementById('latitudepenginapan').value = latitude;
            document.getElementById('longitudepenginapan').value = longitude;
            
            document.getElementById('latitudePenginapanPreview').textContent = latitude;
            document.getElementById('longitudePenginapanPreview').textContent = longitude;
            }
            
            function fillLatitudeLongitudeInputs(latitude, longitude) {
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            
            document.getElementById('latitudePreview').textContent = latitude;
            document.getElementById('longitudePreview').textContent = longitude;
            }
            
            document.addEventListener('DOMContentLoaded', function() {
            initMappenginapan();
            fillLatitudeLongitudepenginapanInputs(initialLatitudepenginapan, initialLongitudepenginapan);
            fillLatitudeLongitudeInputs({{ $kebudayaan->latitude }}, {{ $kebudayaan->longitude }});
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

    @endpush --}}

    @extends('layouts.main')
    
    @section('container')
    
    <style>
        .sembunyi {
            display: none !important;
        }
    </style>
    
    <div class="main-container container-fluid">
    
        <div class="page-header">
            <h1 class="page-title">Edit Wisata Budaya</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Wisata Budaya</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Wisata Budaya</li>
                </ol>
            </div>
        </div>
    
        <div class="row">
            <div class="col-xl-12 col-lg-12">
    
                <div class="card">
    
                    <div class="card-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        <form action="{{ route('destinasi-kebudayaan.update', ['id' => $kebudayaan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <div class="row">
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Wisata Budaya</label>
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            value="{{ $kebudayaan->nama }}" required>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Wisata Budaya</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control"
                                            value="{{ $kebudayaan->alamat }}" required>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="HargaTiket">Harga Tiket</label>
                                        <input type="text" name="HargaTiket" placeholder="2000" id="HargaTiket"
                                            class="form-control" value="{{ $kebudayaan->HargaTiket }}">
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="JamBuka">Jam Buka</label>
                                        <input type="text" name="JamBuka" id="JamBuka" class="form-control"
                                            value="{{ $kebudayaan->JamBuka }}">
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="FasilitasDestinasi">Fasilitas Wisata Budaya</label>
                                        <textarea type="text" name="FasilitasDestinasi" id="FasilitasDestinasi"
                                            class="form-control"
                                            value=""> {{ $kebudayaan->FasilitasDestinasi }} </textarea>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="Deskripsi">Deskripsi Wisata Budaya</label>
                                        <textarea name="Deskripsi" id="Deskripsi"
                                            class="form-control">{{ $kebudayaan->Deskripsi }}</textarea>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="sampul">Sampul Baru</label>
                                        <input type="file" name="sampul" id="sampul" class="form-control-file">
                                        <small class="form-text text-muted">Unggah gambar sampul baru (jpeg, png, jpg,
                                            gif)</small>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="sampul_lama">Sampul Lama</label>
                                        @if ($kebudayaan->sampul)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $kebudayaan->sampul) }}" alt="Sampul Lama"
                                                class="img-fluid" style="max-height: 200px;">
                                        </div>
                                        @else
                                        <p>Tidak ada sampul lama.</p>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="gambar">Gambar Baru</label>
                                        <input type="file" name="gambar[]" id="gambar" class="form-control-file" multiple>
                                        <small class="form-text text-muted">Unggah gambar baru (jpeg, png, jpg,
                                            gif)</small>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="gambar_lama">Gambar Lama</label>
                                        @if ($kebudayaan->gambar)
                                        <div class="row">
                                            @foreach (json_decode($kebudayaan->gambar) as $imagePath)
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-xl-3 mb-5 border-bottom-0">
                                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Gambar Lama"
                                                    class="img-fluid" style="max-height: 200px;">
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <p>Tidak ada gambar lama.</p>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitudePenginapan">Latitude Penginapan</label>
                                        <input type="text" name="latitudepenginapan" id="latitudepenginapan"
                                            class="form-control" value="{{ $kebudayaan->latitudepenginapan }}" readonly
                                            required>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitudePenginapan">Longitude Penginapan</label>
                                        <input type="text" name="longitudepenginapan" id="longitudepenginapan"
                                            class="form-control" readonly
                                            value="{{ $kebudayaan->longitudepenginapan }}" required>
                                    </div>
                                </div>
    
                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control"
                                            value="{{ $kebudayaan->latitude }}" readonly required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 sembunyi">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" readonly
                                            value="{{ $kebudayaan->longitude }}" required>
                                    </div>
                                </div>
    
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="map">Peta Wisata</label>
                                        <div id="map" style="height: 400px;"></div>
                                    </div>
                                </div>
    
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mapPenginapan">Peta Penginapan</label>
                                        <small class="form-text text-muted">Silakan Pilih Lokasi Penginapan *Jika Ada</small>
                                        <div id="mapPenginapan" style="height: 400px;"></div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="hapusKoordinat">
                                        <label class="form-check-label" for="hapusKoordinat">Hapus Koordinat Penginapan</label>
                                    </div>
                                </div>
    
    
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Update Wisata Alam</button>
                                </div>
    
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>

        <script>
            var checkbox = document.getElementById('hapusKoordinat');
                    var latitudePenginapanInput = document.getElementById('latitudepenginapan');
                    var longitudePenginapanInput = document.getElementById('longitudepenginapan');
                    
                    // Tambahkan event listener pada checkbox
                    checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                    // Jika checkbox dicentang, hapus nilai dari kedua input
                    latitudePenginapanInput.value = "";
                    longitudePenginapanInput.value = "";
                    }
                    });
        </script>
    
       <script>
        var mapPenginapan;
            var markerPenginapan;
            var initialLatitudePenginapan = {{ $kebudayaan->latitudepenginapan ?? -3.7406 }};
            var initialLongitudePenginapan = {{ $kebudayaan->longitudepenginapan ?? 119.4786 }};
            
            function initMapPenginapan() {
                mapPenginapan = L.map('mapPenginapan').setView([initialLatitudePenginapan, initialLongitudePenginapan], 13);
            
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapPenginapan);
            
                markerPenginapan = L.marker([initialLatitudePenginapan, initialLongitudePenginapan], {
                    draggable: true
                }).addTo(mapPenginapan);
            
                mapPenginapan.on('click', function(event) {
                    markerPenginapan.setLatLng(event.latlng);
                    fillLatitudeLongitudePenginapan(event.latlng.lat, event.latlng.lng);
                });
            
                document.getElementById('alamatPenginapan').addEventListener('input', function() {
                    var keyword = this.value.trim();
                    if (keyword) {
                        geocodeAlamatPenginapan(keyword);
                    } else {
                        markerPenginapan.setLatLng([initialLatitudePenginapan, initialLongitudePenginapan]);
                        mapPenginapan.setView([initialLatitudePenginapan, initialLongitudePenginapan], 13);
                        fillLatitudeLongitudePenginapan(initialLatitudePenginapan, initialLongitudePenginapan);
                    }
                });
            }
            
            function fillLatitudeLongitudePenginapan(latitudePenginapan, longitudePenginapan) {
                document.getElementById('latitudepenginapan').value = latitudePenginapan;
                document.getElementById('longitudepenginapan').value = longitudePenginapan;
            }
            
            document.addEventListener('DOMContentLoaded', function() {
                initMapPenginapan();
            });
    </script>
    
        <script>
            var map;
                var marker;
                var initialLatitude = {{ $kebudayaan->latitude }};
                var initialLongitude = {{ $kebudayaan->longitude }};
    
                function initMap() {
                    map = L.map('map').setView([initialLatitude, initialLongitude], 13);
    
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
                    marker = L.marker([initialLatitude, initialLongitude], {
                        draggable: true
                    }).addTo(map);
    
                    map.on('click', function(event) {
                        marker.setLatLng(event.latlng);
                        fillLatitudeLongitudeInputs(event.latlng.lat, event.latlng.lng);
                    });
    
                    document.getElementById('alamat').addEventListener('input', function() {
                        var keyword = this.value.trim();
                        if (keyword) {
                            geocodeAlamat(keyword);
                        } else {
                            marker.setLatLng([initialLatitude, initialLongitude]);
                            map.setView([initialLatitude, initialLongitude], 13);
                            fillLatitudeLongitudeInputs(initialLatitude, initialLongitude);
                        }
                    });
                }
    
                function fillLatitudeLongitudeInputs(latitude, longitude) {
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                }
    
                document.addEventListener('DOMContentLoaded', function() {
                    initMap();
                });
        </script>
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
    
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    
    
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