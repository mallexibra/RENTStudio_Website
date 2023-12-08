@extends('layout.admin')

@section('title', 'Create Studio')

@section('content')
    <h1 class="text-purple text-center fw-bold">Create Studio Page</h1>
    <p class="text-center">Create your studio...</p>

    <form action="/admin/studio/create" method="post" style="max-width: 500px; margin: 60px auto;"
        enctype="multipart/form-data">
        @method('POST')
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Studio</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Ex. RENT Studio">
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Ex. RENT Studio">
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="jam_buka" class="form-label">Jam Buka</label>
                <input type="time" class="form-control" name="jam_buka" id="jam_buka">
            </div>
            <div class="col-md-6">
                <label for="jam_tutup" class="form-label">Jam Tutup</label>
                <input type="time" class="form-control" name="jam_tutup" id="jam_tutup">
            </div>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" placeholder="Ex. RENT Studio">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Studio</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="peralatan" class="form-label">Peralatan Studio</label>
            <textarea class="form-control" name="peralatan" id="peralatan" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail Studio</label>
            <input class="form-control" type="file" name="thumbnail" id="thumbnail">
        </div>
        <button type="submit" class="btn d-block w-100 btn-purple">Create Studio</button>
        </div>
    @endsection
