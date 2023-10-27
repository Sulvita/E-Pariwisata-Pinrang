@extends('layouts.main')

@section('container')
    <div class="main-container container-fluid">

        <div class="page-header">
            <h1 class="page-title">List Destinasi Buatan</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Destinasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                
                <div class="card">
                    <div class="card-body pb-4">
                        <form action="{{ route('destinasi-buatan.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari Destinasi Buatan">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">

                    <div class="card-body">
                       
                        <div class="side-app">

                            <div class="row">
                                @foreach ($destinasiBuatanList as $destinasiBuatan)
                                    <div class="col-sm-6 col-md-12 col-lg-3 col-xl-6">
                                        <div class="card"> <a href=""><img class="card-img-top"
                                                    src="{{ url('storage/' . $destinasiBuatan->sampul) }}"
                                                    alt="And this isn't my nose. This is a false one."></a>
                                            <div class="card-body d-flex flex-column">
                                                <h3>{{ $destinasiBuatan->nama }}</a></h3>
                                                <small
                                                    class="d-block text-muted">{{ \Carbon\Carbon::parse($destinasiBuatan->created_at)->locale('id')->diffForHumans() }}</small>
                                                <div class="text-muted pt-2">{{ $destinasiBuatan->alamat }}</div>
                                                <div class="text-muted pt-2 text-justify">
                                                    {{ Str::limit($destinasiBuatan->Deskripsi, 500) }}</div>
                                                <div class="d-flex align-items-center pt-5 mt-auto">
                                                    <div class="ms-auto">
                                                        <a href="{{ route('destinasi-buatan.show', ['id' => $destinasiBuatan->id]) }}"
                                                            class="btn btn-primary">Lihat</a>
                                                        <a href="{{ route('destinasi-buatan.edit', ['id' => $destinasiBuatan->id]) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form
                                                            action="{{ route('destinasi-buatan.destroy', ['id' => $destinasiBuatan->id]) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirmDelete(event)">Hapus</button>
                                                        </form>
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
            </div>
        </div>
    @endsection

    @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: "Berhasil",
                    text: "{{ session('success') }}",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

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
        <script>
            function confirmDelete(event) {
                event.preventDefault(); 
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Destinasi Kuliner ini akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.closest('form').submit();
                    } else {
                        return false;
                    }
                });
            }
        </script>
    @endpush
