@extends('layout.user')

@section('title', 'Booking Studio')

@section('content')
    <h1 class="text-center text-purple fw-bold">Booking Studio</h1>
    <p class="text-center">Silahkan melakukan pembayaran dan upload bukti pembayaran</p>

    <div class="mt-5">
        <div class="d-flex">
            <div>
                <img width="96" src="{{ asset('/pembayaran/qr.png') }}" alt="image-qr">
            </div>
            <div class="bg-purple p-3 rounded shadow-lg max-content">
                <p>Silahkan melakukan pembayaran pada:</p>
                <p class="fw-bold">No. Rekening 1234-2364-9823-8347 a.n RENT Studio (Bank BRI)</p>
            </div>
        </div>
        <form class="p-3 mt-5" action="" method="post">
            @method('POST')
            @csrf
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan Pembayaran</label>
                <input type="text" class="form-control" id="pesan" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="bukti" class="form-label">Bukti Pembayaran</label>
                <input class="form-control" type="file" id="bukti">
            </div>
            <button class="btn fw-semibold btn-purple" type="submit">
                Kirim Bukti Pembayaran
            </button>
        </form>
    </div>
@endsection
