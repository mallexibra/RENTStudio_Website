@extends('layout.admin')

@section('title', 'Detail Transaction')

@section('content')
    <h1 class="text-purple fw-bold">Detail Payment</h1>

    <div class="d-flex mt-5">
        <div class="me-5">
            <h6 class="fs-5 mb-3">Bukti Pembayaran</h6>
            <img width="320px" class="rounded" src="{{ $transaksi['bukti'] }}" alt="bukti-image">
        </div>
        <div>
            <h6 class="fs-5 mb-3">Detail Pembayaran</h6>
            <table class="table">
                <tr>
                    <th scope="col">Waktu Pembayaran</th>
                    <td>{{ $transaksi['date'] }}</td>
                </tr>
                <tr>
                    <th scope="col">Status Pembayaran</th>
                    @if ($transaksi['status'] == 'pending')
                        <td><span class="badge text-bg-secondary">{{ $transaksi['status'] }}</span></td>
                    @elseif($transaksi['status'] == 'approved')
                        <td><span class="badge text-bg-success">{{ $transaksi['status'] }}</span></td>
                    @elseif($transaksi['status'] == 'unapproved')
                        <td><span class="badge text-bg-danger">{{ $transaksi['status'] }}</span></td>
                    @elseif($transaksi['status'] == 'finish')
                        <td><span class="badge text-bg-primary">{{ $transaksi['status'] }}</span></td>
                    @elseif($transaksi['status'] == 'finished')
                        <td><span class="badge text-bg-warning">{{ $transaksi['status'] }}</span></td>
                    @endif
                </tr>
                <tr>
                    <th scope="col">Nama User</th>
                    <td>{{ $transaksi['user']['name'] }}</td>
                </tr>
                <tr>
                    <th scope="col">Nama Studio</th>
                    <td>{{ $transaksi['studios']['nama'] }}</td>
                </tr>
                <tr>
                    <th scope="col">Pesan Pembayaran</th>
                    <td>{{ $transaksi['nama'] }}</td>
                </tr>
                <tr>
                    <th scope="col">Harga Pembayaran</th>
                    <td>Rp. {{ $transaksi['harga'] }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
