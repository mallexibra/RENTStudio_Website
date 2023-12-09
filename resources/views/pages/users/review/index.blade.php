@extends('layout.user')

@section('title', 'Review')

@section('content')
    <h1 class="text-purple text-center fw-bold">Review Kamu</h1>
    <p class="text-center">History review kamu...</p>

    @if (count($reviews) > 0)
        <div class="mt-5 d-flex flex-wrap">
            @foreach ($reviews as $item)
                <div style="max-width: max-content; margin: 8px"
                    class="d-flex bg-lighht p-3 rounded shadow-sm align-items-start">
                    <span class="d-block rounded-circle nav-item text-bg-primary"
                        style="width: 42px; height: 42px; background-size: cover; background-image: url('{{ $item['users']['profile'] }}');"></span>
                    <div class="mx-2">
                        <h6>{{ $item['users']['name'] }}</h6>
                        <p style="font-size: 12px">Studio: {{ $item['studios']['nama'] }}</p>
                        <p style="max-width: 300px">{{ $item['deskripsi'] }}</p>
                    </div>
                    <div>
                        {{ $item['rating'] }} <img src="{{ asset('/icons/star.png') }}" alt="star-icon">
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h6 class="mt-5 text-center">Data masih kosong...</h6>
    @endif
@endsection
