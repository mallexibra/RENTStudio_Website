@extends('layout.user')

@section('title', 'Home')

@section('content')
    <h1 class="text-purple fw-bold">Daftar Studio</h1>
    <p>Pilih studio pilihan kamu...</p>

    <div class="d-flex justify-content-between mt-5">
        <div>
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
        <div style="max-width: 35%">
            <h3 class="fs-5">History Pembayaran</h3>
            @if (count($transaction) > 0)
                <div>
                    @foreach ($transaction as $item)
                        <div class="d-flex bg-lighht p-3 rounded shadow-sm align-items-start">
                            <span class="d-block rounded-circle nav-item text-bg-primary"
                                style="width: 42px; height: 42px; background-image: url({{ $item['user']['profile'] }})"></span>
                            <div class="mx-2">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="me-2">
                                        <p class="fw-semibold">{{ $item['user']['name'] }}</p>
                                        <p style="font-size: 12px">{{ $item['date'] }}</p>
                                    </div>
                                    @if ($item['status'] == 'pending')
                                        <span class="badge bg-secondary">Pending</span>
                                    @elseif($item['status'] == 'approved')
                                        <span class="badge bg-secondary">Approved</span>
                                    @else
                                        <span class="badge bg-secondary">Unapproved</span>
                                    @endif
                                </div>
                                <p class="fw-semibold">Rp. {{ $item['harga'] ? $item['harga'] : '25.000' }}</p>
                                <p>{{ $item['nama'] }}</p>
                                @if ($item['status'] == 'pending')
                                    <a class="btn btn-purple" href="/review/add/{{ $item['studios']['id'] }}">Give a
                                        feedback</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h6>Data masih kosong...</h6>
            @endif
        </div>
    </div>
@endsection
