@extends('layout.user')

@section('title', 'Detail Studio')

@section('content')
    <h1 class="text-center text-purple fw-bold">Detail Studio</h1>
    <p class="text-center">Pesan studio pilihanmu, sekarang...</p>
    @php
        $peralatan = explode("\n", $studio['peralatan']);
    @endphp
    <div class="d-flex align-items-start gap-3 mt-5">
        <div style="width: 45%">
            <img class="w-100 rounded" src="{{ $studio['thumbnail'] }}" alt="{{ $studio['nama'] }}">
        </div>
        <div class="w-100">
            <h3 class="fw-bold">{{ $studio['nama'] }}</h3>
            <div class="d-flex gap-3 align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    <img src="{{ asset('/icons/location.svg') }}" alt="icon-location">
                    <span style="font-size: 12px">{{ $studio['lokasi'] }}</span>
                </div>
                <span>|</span>
                @if ($studio['status'] == 'tersedia')
                    <span class="badge rounded-pill text-bg-success">Tersedia</span>
                @else
                    <span class="badge rounded-pill text-bg-danger">Tidak Tersedia</span>
                @endif
            </div>
            <div class="deskripsi">
                <p class="fw-semibold mt-3">Deskripsi</p>
                <p>{{ $studio['deskripsi'] }}</p>
            </div>
            <div class="waktu">
                <p class="fw-semibold mt-3">Jam Buka</p>
                <p>{{ $studio['jam_buka'] }} - {{ $studio['jam_tutup'] }}</p>
            </div>
            <div class="peralatan">
                <p class="fw-semibold mt-3">Peralatan</p>
                <ul>
                    @foreach ($peralatan as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <a href="/studio/{{ $studio['id'] }}/booking" class="btn btn-purple">Booking Sekarang</a>

        </div>
        <div class="w-50">
            <p class="fw-bold mb-3 fs-5">Review and Rating</p>
            <div class="overlay">
                @foreach ($reviews as $review)
                    <div class="d-flex gap-3">
                        <div>
                            <span class="d-block rounded-circle nav-item text-bg-primary"
                                style="width: 42px; height: 42px"></span>
                        </div>
                        <div class="w-auto">
                            <p class="fw-semibold">{{ $review['users']['name'] }}</p>
                            <div class="d-flex fw-medium gap-2">
                                <span>Rating: </span>
                                <img src="{{ asset('/icons/star-fill.svg') }}" alt="icon-star">
                                <span>{{ $review['rating'] }}</span>
                            </div>
                            <p>{{ $review['deskripsi'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
