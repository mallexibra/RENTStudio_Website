@extends('layout.admin')

@section('title', 'Studio Admin')

@section('content')
    <h1 class="text-purple fw-bold">Reviews Page</h1>
    <div class="mt-5">

        @if (count($studios) > 0)
            @foreach ($studios as $studio)
                <h4 class="fw-bold">{{ $studio['nama'] }}</h4>
                @if (count($studio['reviews']) > 0)
                    <div class="d-flex mb-5">
                        @foreach ($studio['reviews'] as $item)
                            <div class="d-flex justify-content-between me-3" style="max-width: 420px">
                                <img class="max-content" src={{ asset('/profile/' . $item['users']['profile']) }}
                                    class="card-img-top" alt={{ $item['users']['name'] }}>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item['users']['name'] }}</h5>
                                    <p class="card-text">{{ $item['deskripsi'] }}</p>
                                </div>
                                <div>
                                    {{ $item['rating'] }} <img src="{{ asset('/icons/star.png') }}" alt="star-icon">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h6>Review sedang kosong...</h6>
                @endif
            @endforeach
        @else
            <h6>Data sedang kosong...</h6>
        @endif
    </div>
@endsection
