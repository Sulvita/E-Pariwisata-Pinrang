{{-- @extends('layouts.pengunjung')

@section('container')
    <div class="container">

    <div class="row">

        <div class="col-xl-12">
            <div class="card mt-6">
                <img class="card-img-top mt-6" src="{{ asset('storage/' . $destination->sampul) }}" alt="Card image cap">
                <div class="card-body">
                    <div class="d-md-flex">

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-clock fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $destination->created_at->diffForHumans() }}
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i
                                class="fe fe-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $destination->created_at->translatedFormat('l d F Y') }}
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-star fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                Rating: {{ number_format($destination->averageRating(), 2) }}
                            </div>
                        </a>

                        <div class="ms-auto">
                            <a href="javascript:void(0);" class="d-flex mb-2">
                                <i
                                    class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                <div class=" mt-3 ms-1 text-muted font-weight-semibold">{{
                                    $destination->totalKomentar() }} Komentar</div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <h3><a href="javascript:void(0)"> {{ $destination->nama }}</a></h3>
                    
                    @if($destination->alamat)
                    <p class="card-text">Alamat: {{ $destination->alamat }}</p>
                    @endif

                    @if($destination->HargaTiket)
                    <p class="card-text">Harga Tiket: {{ $destination->HargaTiket }}</p>
                    @endif
                    
                    @if($destination->FasilitasDestinasi)
                    <p class="card-text">Fasilitas Destinasi: {{ $destination->FasilitasDestinasi }}</p>
                    @endif
                    
                    @if($destination->JamBuka)
                    <p class="card-text">Jam Buka: {{ $destination->JamBuka }}</p>
                    @endif
                    
                    @if($destination->Deskripsi)
                    <p class="card-text">Deskripsi: {{ $destination->Deskripsi }}</p>
                    @endif
                    
                    @if($destination->Sejarah)
                    <p class="card-text">Sejarah: {{ $destination->Sejarah }}</p>
                    @endif

                    @if($destination->MenuKuliner)
                    <p class="card-text">Menu Kuliner: {{ $destination->MenuKuliner }}</p>
                    @endif

                    @if ($destination->gambar)
                    <div class="row">
                        @foreach (json_decode($destination->gambar) as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gambar" class="img-fluid">
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="ms-auto">
                        <div id="map" style="height: 250px;"></div>
                    </div>
                    <a href="https://www.google.com/maps?q={{ $destination->latitude }},{{ $destination->longitude }}"
                        target="_blank" class="btn block btn-primary mt-2">Lihat di Google Maps</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Commentar</div>
                </div>

                @foreach ($destination->komentars as $komentar)
                <div class="card-body pb-0">
                    <div class="media mb-1 overflow-visible d-block d-sm-flex">
                        <div class="me-3 mb-2">
                            <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64"
                                    src="../assets/images/users/2.jpg"> </a>
                        </div>
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
                    <div class="card-title">Add a Comments</div>
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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Komentar dan Rating</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

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

@endsection --}}


{{-- @extends('layouts.pengunjung')

@section('container')
<div class="main-content app-content mt-4" id="">

    <div class="row">

        <div class="col-xl-7">
            <div class="card mt-6">
                <img class="card-img-top mt-6" src="{{ asset('storage/' . $destination->sampul) }}"
                    alt="Card image cap">
                <div class="card-body">
                    <div class="d-md-flex">

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-clock fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $destination->created_at->diffForHumans() }}
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i
                                class="fe fe-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $destination->created_at->translatedFormat('l d F Y') }}
                            </div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex me-4 mb-2">
                            <i class="fe fe-star fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                Rating: {{ number_format($destination->averageRating(), 2) }}
                            </div>
                        </a>

                        <div class="ms-auto">
                            <a href="javascript:void(0);" class="d-flex mb-2">
                                <i
                                    class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                <div class=" mt-3 ms-1 text-muted font-weight-semibold">{{
                                    $destination->totalKomentar() }} Komentar</div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <h3><a href="javascript:void(0)"> {{ $destination->nama }}</a></h3>
                    <p class="card-text">{{ $destination->alamat }}</p>
                    <p class="text-justify"> {{ $destination->Deskripsi }}</p>

                    @if ($destination->gambar)
                    <div class="row">
                        @foreach (json_decode($destination->gambar) as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gambar" class="img-fluid">
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="ms-auto">
                        <div id="map" style="height: 250px;"></div>
                    </div>
                    <!-- Replace $destination->latitude and $destination->longitude with the actual variables holding the latitude and longitude values -->
                    <a href="https://www.google.com/maps?q={{ $destination->latitude }},{{ $destination->longitude }}"
                        target="_blank" class="btn block btn-primary mt-2">Lihat di Google Maps</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Commentar</div>
                </div>

                @foreach ($destination->komentars as $komentar)
                <div class="card-body pb-0">
                    <div class="media mb-1 overflow-visible d-block d-sm-flex">
                        <div class="me-3 mb-2">
                            <a href="profile.html"> <img class="media-object rounded-circle thumb-sm" alt="64x64"
                                    src="../assets/images/users/2.jpg"> </a>
                        </div>
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
                    <div class="card-title">Add a Comments</div>
                </div>
                <div class="card-body">


                    <form action="{{ route('pengunjung.kebudayaan.tambah-komentar', $destination) }}"
                        method="POST">
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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Komentar dan Rating</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-xl-5 mt-6">

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Artikel Terkait</div>
                </div>
                @foreach ($daftarkebudayaanTerbaru as $postinganTerbaru)
                <div class="card-body">
                    <div class="">
                        <div class="d-flex overflow-visible">
                            <a href="{{ route('pengunjung.kebudayaan.show', $postinganTerbaru) }}"
                                class="card-aside-column br-5 cover-image"
                                data-bs-image-src="{{ asset('storage/' . $postinganTerbaru->sampul) }}"
                                style="background: url('{{ asset('storage/' . $postinganTerbaru->sampul) }}') center center;"></a>
                            <div class="ps-3 flex-column">
                                <h4><a href="{{ route('pengunjung.kebudayaan.show', $postinganTerbaru) }}">{{
                                        $postinganTerbaru->nama }}</a>
                                </h4>
                                <div class="text-muted">{{ $postinganTerbaru->alamat }}</div>
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


@endsection --}}


@extends('layouts.pengunjung')

@section('container')

<div class="container">
    <div class="row">

        <div class="col-12 col-md-12">
            <div class="card mt-6">
                <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img class="d-block w-100 br-5" alt=""
                                src="{{ asset('storage/' . $destination->sampul) }}"
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
                        <div class="col-12 col-lg-12">
                            <div class="">
                                <span class="fw-bold me-2">Lokasi :</span>
                                <div class="ms-auto">
                                    <div id="map" style="height: 250px;"></div>
                                </div>
                                <a href="https://www.google.com/maps?q={{ $destination->latitude }},{{ $destination->longitude }}"
                                    target="_blank" class="btn btn-primary block">Buka di Google
                                    Maps</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-7 mt-6">

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
                    <form action="{{ route('destination.tambah-komentar', $destination) }}"
                        method="POST">
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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Tambah Komentar dan Rating</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-5 mt-6">
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