@extends('layout.user')

@section('title', 'Home')

@section('content')
    <h1 class="text-center text-purple fw-bold">Daftar Studio</h1>
    <p class="text-center">Pilih studio pilihan kamu...</p>

    <div class="container">
        @foreach ($studios as $studio)
            <div class="card" style="width: 18rem;">
                <img src={{ $studio['thumbnail'] }} class="card-img-top" alt={{ $studio['nama'] }}>
                <div class="card-body">
                    <h5 class="card-title">{{ $studio['nama'] }}</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, hic.</p>
                    <a href="/studio/{{ $studio['id'] }}" class="btn btn-purple">Lihat
                        Detail</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
