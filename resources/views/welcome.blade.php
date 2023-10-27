<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/logo-2.png') }}" />
    <title>E-Pariwisata</title>
    <style>
        @media (min-width: 0px) {
            .image-container {
                position: relative;
                height: 60vh;
            }
    
            .centered-image {
                object-fit: cover;
                height: 100%;
                width: 100%;
            }
    
            .image-text {
                position: absolute !important;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white !important;
                background-color: rgba(0, 0, 0, 0.7) !important;
                padding: 20px !important;
                border-radius: 20px;
                text-align: center;
                font-weight: bold;
                letter-spacing: 2px;
            }
        }
    
        @media (max-width: 0px) {
            .image-container {
                position: relative;
                height: 100vh;
            }
    
            .centered-image {
                object-fit: cover;
                height: 100%;
                width: 100%;
            }
    
            .image-text {
                display: none;
            }
    
            /* Mengatur lebar elemen agar teks muat dengan baik */
            .image-text-container {
                width: 80%;
                /* Misalnya, mengatur lebar menjadi 80% dari lebar viewport */
                margin: 0 auto;
                /* Mengatur elemen menjadi tengah */
            }
    
            .boldd {
                font-weight: 800;
                /* Mengatur tingkat ketebalan teks, misalnya 800 untuk lebih tebal */
            }
        }
    
        @media (max-width: 767px) {
    
            /* Misalnya, untuk perangkat mobile dengan lebar maksimum 767px */
            /* Mengatur ukuran font lebih kecil untuk perangkat mobile */
            .boldd {
                font-weight: normal;
                /* Mengatur kembali font-weight ke normal untuk perangkat mobile */
                font-size: 16px !important;
                /* Mengatur ukuran font lebih kecil untuk perangkat mobile */
            }
        }
    </style>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
    <!-- STYLE CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/dark-style.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/colors/color1.css" />

</head>

<body class="app ltr landing-page horizontal">

    <!-- GLOBAL-LOADER -->
    @include('layouts.pengunjung.loader')
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('layouts.pengunjung.header')

            <!-- /app-Header -->

            <div class="landing-top-header overflow-hidden">
            
                @include('layouts.pengunjung.headerlink')
            
                <div class="demo-screen-headlin main-demo main-demo-1 spacing-to overflow-hidden reveal active" id="home">
                    <div class="row">
                        <div class="col-12 col-xl-12 col-lg-12 my-auto">
                            <div class="image-container">
                                <img class="w-full centered-image" src="{{ asset('assets/images/banner/banner.jpg') }}" alt="">
                                <div class="image-text">
                                    <h2 class="boldd">E-PARIWISATA PINRANG</h2>
                                    <p>Menjadi Solusi Perjalanan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

            <!--app-content open-->
            <div class="main-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container">
                        <div class="">

                            <!-- FITUR LIST -->
                            <div class="sptb section bg-white" id="Features">
                                <div class="container">
                                    <div class="row">
                                        {{-- <h4 class="text-center fw-semibold">Fitur E-Pariwisata</h4> --}}
                                        <span class="landing-title"></span>
                                        <h2 class="fw-semibold text-center">Kabupaten Pinrang, Sulawesi Selatan</h2>
                                        <p class="text-default mb-5 text-center">E-Pariwisata ini memiliki beberapa
                                            pilihan destinasi penunjang untuk liburan akhir pekan anda.</p>
                                        <div class="row mt-7">
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card overflow-hidden">
                                                    <img src="{{ asset('assets/images/banner/alam.jpg') }}" class="card-img-top" alt="img">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">Wisata Alam</h5>
                                                        <p class="card-text text-justify">Nikmati keindahan alam yang
                                                            mempesona dengan destinasi wisata alam kami.
                                                            Jelajahi pegunungan yang hijau, air terjun yang memukau, dan
                                                            pantai pasir putih yang menakjubkan.</p>
                                                        <a href="{{ route('pengunjung.destinasi.index') }}" class="btn btn-primary">Jelajahi</a>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card overflow-hidden">
                                                    <img src="{{ asset('assets/images/banner/budaya.jpg') }}" class="card-img-top" alt="img">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">Wisata Budaya</h5>
                                                        <p class="card-text text-justify">Rasakan kekayaan budaya kami
                                                            dengan destinasi wisata budaya.
                                                            Kunjungi situs-situs bersejarah, museum yang menarik, dan
                                                            festival budaya yang meriah.</p>
                                                        <a href="{{ route('pengunjung.kebudayaan.index') }}" class="btn btn-primary">Jelajahi</a>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card overflow-hidden">
                                                    <img src="{{ asset('assets/images/banner/buatan.jpg') }}" class="card-img-top" alt="img">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">Wisata Buatan</h5>
                                                        <p class="card-text text-justify">Jelajahi destinasi wisata
                                                            buatan yang memukau. Dapatkan pengalaman tak
                                                            terlupakan di tempat-tempat rekreasi dan atraksi buatan
                                                            kami. Bersama keluarga dan teman-teman, nikmati
                                                            serunya perjalanan Anda di destinasi wisata ini.</p>
                                                        <a href="{{ route('pengunjung.buatan.index') }}" class="btn btn-primary">Jelajahi</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .square-image {
                                    width: 200px;
                                    /* Sesuaikan lebar gambar sesuai kebutuhan */
                                    height: 200px;
                                    /* Tinggi gambar sama dengan lebar untuk membuatnya persegi panjang */
                                }

                                .description {
                                    display: -webkit-box;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 3;
                                    /* Batas jumlah baris yang ingin ditampilkan */
                                    overflow: hidden;
                                }
                            </style>

                            <div class="section bg-landing" id="Blog">
                                <div class="container">
                                    <div class="row">
                                        <h4 class="text-center fw-semibold">Postingan</h4>
                                        <span class="landing-title"></span>
                                        <h2 class="text-center fw-semibold mb-7">Postingan Dengan Rating Tertinggi.
                                        </h2>

                                        <div id="topRatedDestinationsContainer" class="row">
                                            @foreach ($topRatedDestinations->take(2) as $destination)
                                                <div class="col-lg-6">
                                                    <div class="card bg-transparent reveal active">
                                                        <div class="card-body px-1">
                                                            <div class="d-flex overflow-visible">
                                                                <a href="{{ route('destination.show', ['destination' => $destination->id]) }}"
                                                                    class="card-aside-column br-5 cover-image"
                                                                    data-bs-image-src={{ asset('storage/' . $destination->sampul) }}
                                                                    style="background: url(&quot;{{ asset('storage/' . $destination->sampul) }}&quot;)   center center;"></a>
                                                                <div class="ps-3 flex-column">
                                                                    <span
                                                                        class="badge bg-primary me-1 mb-1 mt-1 text-uppercase">{{ $destination->kategori }}</span>
                                                                    <h3><a
                                                                            href="{{ route('destination.show', ['destination' => $destination->id]) }}">{{ $destination->nama }}</a>
                                                                    </h3>
                                                                    <p>Alamat: {{ $destination->alamat }}</p>
                                                                    <p>Rating Rata-rata:
                                                                        {{ number_format($destination->komentars_avg_rating, 2) }}
                                                                    </p>
                                                                    <a href="{{ route('destination.show', ['destination' => $destination->id]) }}"
                                                                        class="btn btn-primary btn-sm btn-block">Lihat
                                                                        Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div id="hiddenDestinations" class="row" style="display: none;">
                                            @foreach ($topRatedDestinations->slice(2) as $destination)
                                                <div class="col-lg-6">
                                                    <div class="card bg-transparent reveal active">
                                                        <div class="card-body px-1">
                                                            <div class="d-flex overflow-visible">
                                                                <a href="{{ route('destination.show', ['destination' => $destination->id]) }}"
                                                                    class="card-aside-column br-5 cover-image"
                                                                    data-bs-image-src={{ asset('storage/' . $destination->sampul) }}
                                                                    style="background: url(&quot;{{ asset('storage/' . $destination->sampul) }}&quot;) center
                                                                center;"></a>
                                                                <div class="ps-3 flex-column">
                                                                    <span
                                                                        class="badge bg-primary me-1 mb-1 mt-1 text-uppercase">{{ $destination->kategori }}</span>
                                                                    <h3><a
                                                                            href="{{ route('destination.show', ['destination' => $destination->id]) }}">{{ $destination->nama }}</a>
                                                                    </h3>
                                                                    <p>Alamat: {{ $destination->alamat }}</p>
                                                                    <p>Rating Rata-rata:
                                                                        {{ number_format($destination->komentars_avg_rating, 2) }}
                                                                    </p>
                                                                    <a href="{{ route('destination.show', ['destination' => $destination->id]) }}"
                                                                        class="btn btn-primary btn-sm btn-block">Lihat
                                                                        Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                        <div class="text-center d-flex justify-content-center">
                                            <button id="showMoreButton" class="btn btn-primary">Lihat Lebih  Banyak</button>
                                            <button id="hideMoreButton" class="btn btn-primary" style="display: none;">Sembunyikan Lebih Banyak</button>
                                        </div>
                                        <div class="text-center d-flex justify-content-center mt-2">
                                            <a href="{{ route('semua.postingan') }}" class="btn btn-primary">Lihat Semua Postingan</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            @foreach ($data as $item)
                                <div class="section">
                                    <div class="container">
                                        <div class="row">
                                            <section class="sptb demo-screen-demo" id="faqs">
                                                <div class="container text-center">

                                                    <div class="row align-items-center">
                                                        <h4 class="text-center fw-semibold">Visi dan Misi</h4>
                                                        <span class="landing-title"></span>
                                                        {{-- <h2 class="text-center fw-semibold"></h2> --}}
                                                        <div class="col-lg-12">
                                                            <div class="row justify-content-center">
                                                                <p class="col-lg-9 text-default sub-text mb-7">
                                                                    {{ $item->visi_misi }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center">
                                                        <h4 class="text-center fw-semibold">Deskripsi</h4>
                                                        <span class="landing-title"></span>
                                                        {{-- <h2 class="text-center fw-semibold"></h2> --}}
                                                        <div class="col-lg-12">
                                                            <div class="row justify-content-center">
                                                                <p class="col-lg-9 text-default sub-text mb-7">
                                                                    {{ $item->Deskripsi }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center">
                                                        <h4 class="text-center fw-semibold">Sejarah</h4>
                                                        <span class="landing-title"></span>
                                                        {{-- <h2 class="text-center fw-semibold"></h2> --}}
                                                        <div class="col-lg-12">
                                                            <div class="row justify-content-center">
                                                                <p class="col-lg-9 text-default sub-text mb-7">
                                                                    {{ $item->sejarah }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

   

                                                    <div class="row align-items-center">
                                                        <h4 class="text-center fw-semibold">Letak Geografis</h4>
                                                        <span class="landing-title"></span>
                                                        {{-- <h2 class="text-center fw-semibold"></h2> --}}
                                                        <div class="col-lg-12">
                                                            <div class="row justify-content-center">
                                                                <p class="col-lg-9 text-default sub-text mb-7">
                                                                    {{ $item->geografis }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!-- CONTAINER CLOSED-->
                </div>
            </div>
            <!--app-content closed-->
        </div>

        <!-- FOOTER OPEN -->
        @include('layouts.pengunjung.footer')
        <!-- FOOTER CLOSED -->
    </div>

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                strings: ['E-Pariwisata Kabupaten Soppeng'],
                typeSpeed: 100, // Speed of typing in milliseconds
                backSpeed: 50, // Speed of backspacing in milliseconds
                loop: true // Set to true to keep looping the animation
            };

            var typed = new Typed('#typed-text', options);
        });
    </script>
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


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/counters/counterup.min.js"></script>
    <script src="../assets/plugins/counters/waypoints.min.js"></script>
    <script src="../assets/plugins/counters/counters-1.js"></script>
    <script src="../assets/plugins/owl-carousel/owl.carousel.js"></script>
    <script src="../assets/plugins/company-slider/slider.js"></script>
    <script src="../assets/plugins/rating/jquery-rate-picker.js"></script>
    <script src="../assets/plugins/rating/rating-picker.js"></script>
    <script src="../assets/plugins/ratings-2/jquery.star-rating.js"></script>
    <script src="../assets/plugins/ratings-2/star-rating.js"></script>
    <script src="../assets/js/sticky.js"></script>
    <script src="../assets/js/landing.js"></script>

</body>

</html>
