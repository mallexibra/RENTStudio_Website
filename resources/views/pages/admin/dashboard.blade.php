@extends('layout.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-purple fw-bold">Dashboard Page</h1>

    <div class="d-flex mt-5">
        <div class="w-50">
            <div class="p-3 bg-dark-purple max-content rounded text-white">
                <p class="fs-5 fw-bold">Total Saldo Anda</p>
                <p class="fw-semibold">Rp. {{ $saldo }}</p>
                <p class="sub-title mt-3">Statistik Transaksi</p>
                <div class="d-flex mt-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded me-3 bg-purple" style="width: 32px; height: 32px;"></div>
                        <div>
                            <p class="text-xs">Total Transaksi</p>
                            <p class="fw-bold fs-5">{{ $totalTransaksi }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mx-3">
                        <div class="rounded me-3 bg-purple" style="width: 32px; height: 32px;"></div>
                        <div>
                            <p class="text-xs">Transaksi Masuk</p>
                            <p class="fw-bold fs-5">{{ $totalTransaksiMasuk }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="rounded me-3 bg-purple" style="width: 32px; height: 32px;"></div>
                        <div>
                            <p class="text-xs">Transaksi Berhasil</p>
                            <p class="fw-bold fs-5">{{ $totalTransaksiBerhasil }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-50">
            <p class="sub-title">History Transaksi</p>
            @if (count($transaksis) > 0)
                <div class="overlay max-content">
                    @foreach ($transaksis as $item)
                        <div class="d-flex bg-lighht max-content p-3 rounded shadow-sm align-items-center">
                            <span class="d-block rounded-circle nav-item text-bg-primary"
                                style="width: 42px; height: 42px; background-size: cover; background-image: url({{ asset('/profiles/') }});"></span>
                            <div class="mx-3">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="me-2">
                                        <p class="fw-semibold">Maulana Malik Ibrahim</p>
                                        <p style="font-size: 12px">dfgdf</p>
                                    </div>
                                </div>
                                <p>dfgfd</p>
                            </div>
                            <p class="fw-semibold text-purple">Rp. {{ '25.000' }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <h6>Data transaksi kosong...</h6>
            @endif
        </div>
    </div>
@endsection
