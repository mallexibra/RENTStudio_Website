@extends('layout.user')

@section('title', 'Home')

@section('content')
    <h1 class="text-purple text-center fw-bold">Daftar Studio</h1>
    <p class="text-center">Pilih studio pilihan kamu...</p>

    <div class="d-flex mt-5">
        @foreach ($studios as $studio)
            <div class="card me-3 mb-3" style="width: 18rem;">
                <img src={{ $studio['thumbnail'] }} class="card-img-top" alt={{ $studio['nama'] }}>
                <div class="card-body">
                    <h5 class="card-title">{{ $studio['nama'] }}</h5>
                    <p class="card-text">{{ $studio['deskripsi'] }}</p>
                    <a href="/studio/{{ $studio['id'] }}" class="btn mt-2 btn-purple">Lihat
                        Detail</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
