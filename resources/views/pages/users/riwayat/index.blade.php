@extends('layout.user')

@section('title', 'History')

@section('content')
    <h1 class="text-purple text-center fw-bold">History Pembayaran</h1>
    <p class="text-center">Pilih studio pilihan kamu...</p>

    <div class="mt-5 mx-auto" style="max-width: 35%">
        @if (count($transaction) > 0)
            <div>
                @foreach ($transaction as $item)
                    <div class="d-flex bg-lighht p-3 rounded shadow-sm align-items-start">
                        <span class="d-block rounded-circle nav-item text-bg-primary"
                            style="width: 42px; height: 42px; background-size: cover; background-image: url({{ asset('/profiles/' . $item['user']['profile']) }});"></span>
                        <div class="mx-2">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="me-2">
                                    <p class="fw-semibold">{{ $item['user']['name'] }}</p>
                                    <p style="font-size: 12px">{{ $item['date'] }}</p>
                                </div>
                                @if ($item['status'] == 'pending')
                                    <span class="badge bg-secondary">Pending</span>
                                @elseif($item['status'] == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($item['status'] == 'unapproved')
                                    <span class="badge bg-danger">Unapproved</span>
                                @elseif($item['status'] == 'finish')
                                    <span class="badge bg-primary">Finish</span>
                                @elseif($item['status'] == 'finished')
                                    <span class="badge bg-primary">Finished</span>
                                @endif
                            </div>
                            <p class="fw-semibold">Rp. {{ $item['harga'] ? $item['harga'] : '25.000' }}</p>
                            <p>{{ $item['nama'] }}</p>
                            @if ($item['status'] == 'finish')
                                <a class="btn btn-purple" href="/review/add/{{ $item['id'] }}">Give a
                                    feedback</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h6 class="text-center">Data masih kosong...</h6>
        @endif
    </div>
@endsection
