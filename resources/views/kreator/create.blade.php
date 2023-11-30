@extends('layouts.pengunjung')

@section('container')
    <div class="section bg-landing" id="Blog">
        <div class="container">

            <div class="row">
                <h4 class="text-center fw-semibold bok">TAMBAH LOKASI DESTINASI </h4>
                <span class="landing-title"></span>
                <h5 class="text-center fw-semibold mb-7">Dengan fitur ini, semua orang
                dapat mengeksplorasi lokasi wisata yang belum
                pernah terjamah sebelumnya
                oleh pengunjung lainnya, dan berbagi destinasi
                baru yang menarik bagi komunitas perjalanan
                kami.</h5>

                <div class="card">

                    <form class="form-horizontal" action="{{ route('kreator.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class=" row mb-4">
                                <label for="inputName" class="col-md-3 form-label">Nama Destinasi*</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="inputName" placeholder=""
                                        autocomplete="username" name="nama">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="kategori"  class="col-md-3 form-label">Kategori Destinasi*</label>
                                <div class="col-md-9">
                                    <select name="kategori" class="form-control select2 select2-dropdown">
                                        <option value="wisata">
                                            Wisata Alam
                                        </option>
                                        <option value="buatan">
                                            Wisata Buatan
                                        </option>
                                        <option value="kebudayaan">
                                            Wisata Kebudayaan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="alamat" class="col-md-3 form-label">Alamat Destinasi*</label>
                                <div class="col-md-9">
                                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder=""
                                        autocomplete="username">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="tiket" class="col-md-3 form-label">Harga
                                    Tiket</label>
                                <div class="col-md-9">
                                    <input type="number" name="HargaTiket" class="form-control" id="tiket"
                                        placeholder="">
                                        <small class="text-danger">Optional</small class="text-danger">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="jambuka" class="col-md-3 form-label">Jam Buka</label>
                                <div class="col-md-9">
                                    <input type="time" name="JamBuka" class="form-control" id="tiket"
                                        placeholder="time">
                                    <small class="text-danger">Optional</small class="text-danger">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="jambuka" class="col-md-3 form-label">Fasilitas Destinasi
                                </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="FasilitasDestinasi" class="FasilitasDestinasi" placeholder="Fasilitas Destinasi" id="floatingTextarea2"
                                        style="height: 100px"></textarea>
                                    <small class="text-danger">Optional</small class="text-danger">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="jambuka" class="col-md-3 form-label">Deskripsi Destinasi</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="Deskripsi" placeholder="Deskripsi" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <small class="text-danger">Optional</small class="text-danger">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="jambuka" class="col-md-3 form-label">Sampul*</label>
                                <div class="col-md-9">
                                    <input type="file" required name="sampul" class="form-control-file" id="sampul">
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="jambuka" class="col-md-3 form-label">Gambar
                                    Lainya*</label>
                                <div class="col-md-9">
                                    <input type="file" name="gambar[]" required id="gambar" class="form-control-file"
                                        multiple>
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="Lokasi" class="col-md-3 form-label">Lokasi Destinasi*</label>
                                <div class="col-md-9">
                                    <div id="map" style="height: 400px;"></div>
                                </div>
                            </div>

                            <div class=" row mb-4">
                                <label for="Lokasi  Penginapan Terdekat" class="col-md-3 form-label">Lokasi  Penginapan Terdekat</label>
                                <div class="col-md-9">
                                    <div id="mapPenginapan" style="height: 400px;"></div>
                                    <small class="text-danger">Optional</small class="text-danger">
                                </div>
                            </div>


                            <style>
                                .sembunyi {
                                    display: none !important;
                                }
                            </style>
                            {{-- HIDDEN --}}
                            <div class="col-12 col-lg-6 sembunyi">
                                <div class="form-group">
                                    <label for="latitude" class="sr-only">Latitude (Titik
                                        Koordinat)</label>
                                    <input type="text" required name="latitude" id="latitude" class="form-control"
                                        required readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 sembunyi">
                                <div class="form-group">
                                    <label for="longitude" class="sr-only">Longitude (Titik
                                        Koordinat)</label>
                                    <input type="text" required name="longitude" id="longitude" class="form-control"
                                        required readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 sembunyi">
                                <div class="form-group">
                                    <label for="latitudepenginapan" class="sr-only">Latitude
                                        Penginapan</label>
                                    <input type="text" required name="latitudepenginapan" id="latitudepenginapan"
                                        class="form-control" required readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 sembunyi">
                                <div class="form-group">
                                    <label for="longitudepenginapan" class="sr-only">Longitude
                                        Penginapan</label>
                                    <input type="text" required name="longitudepenginapan" id="longitudepenginapan"
                                        class="form-control" required readonly>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Save changes</button> 
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>

    <script>
        var showMoreButton = document.getElementById('showMoreButton');
            var hideMoreButton = document.getElementById('hideMoreButton');
            var hiddenDestinationsContainer = document.getElementById('hiddenDestinations');
    
            showMoreButton.addEventListener('click', showHiddenDestinations);
            hideMoreButton.addEventListener('click', hideHiddenDestinations);
    
            function showHiddenDestinations() {
                hiddenDestinationsContainer.style.display = 'flex';
                showMoreButton.style.display = 'none';
                hideMoreButton.style.display = 'block';
            }
    
            function hideHiddenDestinations() {
                hiddenDestinationsContainer.style.display = 'none';
                showMoreButton.style.display = 'flex';
                hideMoreButton.style.display = 'none';
            }
    </script>
    
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
@endsection

@push('scripts')
    
@endpush
