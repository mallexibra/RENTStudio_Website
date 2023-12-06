@extends('layout.user')

@section('title', 'Home')

@section('content')
    <h1 class="text-purple text-center fw-bold">Daftar Studio</h1>
    <p class="text-center">Pilih studio pilihan kamu...</p>

    <div class="d-flex justify-content-between mt-5">
        @foreach ($studios as $studio)
            <div class="card" style="width: 18rem;">
                <img src={{ $studio['thumbnail'] }} class="card-img-top" alt={{ $studio['nama'] }}>
                <div class="card-body">
                    <h5 class="card-title">{{ $studio['nama'] }}</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, hic.</p>
                    <a href="/studio/{{ $studio['id'] }}" class="btn mt-2 btn-purple">Lihat
                        Detail</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
