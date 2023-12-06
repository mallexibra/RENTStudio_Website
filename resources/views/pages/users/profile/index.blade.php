@extends('layout.user')

@section('title', 'Edit Profile')

@section('content')
    <h1 class="text-center text-purple fw-bold">Edit Profile</h1>
    <p class="text-center">Edit informasi profile mu...</p>

    <form action="/profile/edit/{{ $profile['id'] }}" method="POST" enctype="multipart/form-data" class="mx-auto mt-5"
        style="max-width: 35%">
        @method('POST')
        @csrf
        <div class="bg-purple mx-auto rounded"
            style="width: 120px; background-image: url({{ $profile['profile'] }}); height: 120px; background-repeat: no-repeat; background-size: cover;">
        </div>
        <label for="fileInput" class="btn d-block mt-2 mx-auto btn-purple" id="fileInputLabel">Choose
            File</label>
        <input type="file" name="profile" id="fileInput" onchange="handleFileSelect(event)" />

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" required value="{{ $profile['name'] }}" name="name" class="form-control" id="name"
                placeholder="John Dea">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" required name="email" value="{{ $profile['email'] }}" class="form-control"
                id="email" placeholder="johndea@rent.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="**************">
        </div>
        <button type="submit" class="btn my-3 w-100 btn-purple">Edit Profile</button>
        <a href="/" class="btn mb-5 w-100 btn-red">Cancel Edit Profile</a>
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
