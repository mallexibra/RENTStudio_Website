@extends('layout.user')

@section('title', 'Create Profile')

@section('content')
    <h1 class="text-center text-purple fw-bold">Create Profile</h1>
    <p class="text-center">Create informasi profile mu...</p>

    <form action="/admin/account/create" method="POST" enctype="multipart/form-data" class="mx-auto mt-5"
        style="max-width: 35%">
        @method('POST')
        @csrf

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" required name="name" class="form-control" id="name" placeholder="John Dea">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" required class="form-control" name="email" id="email"
                placeholder="johndea@rent.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" required name="password" class="form-control" id="password"
                placeholder="**************">
        </div>
        <div class="mb-3">
            <label for="profile" class="form-label">Foto Profil</label>
            <input class="form-control" required type="file" name="profile" id="profile">
        </div>
        <button type="submit" class="btn my-3 w-100 btn-purple">Create Profile</button>
        <a href="/admin/account" class="btn mb-5 w-100 btn-red">Cancel Create Profile</a>
    </form>

    <script>
        function handleFileSelect(event) {
            const fileInput = event.target;
            const selectedFile = fileInput.files[0].name;

            if (selectedFile) {
                document.getElementById('fileInputLabel').innerText = selectedFile;
            }
        }
    </script>
@endsection
