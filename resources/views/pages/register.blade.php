<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENT Studio | Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"></script>
</head>

<body>

    <div class="d-flex min-vh-100 flex-column align-items-center justify-content-center">
        <img width="182" src="{{ asset('/icons/logo.png') }}" alt="RENTStudio-Logo">
        <h1 class="fw-bold mt-5">SIGNUP USER</h1>
        <p>Please input your account...</p>

        <form style="min-width: 390px; max-width: 520px" class="p-3 border rounded mt-5" action="/register"
            enctype="multipart/form-data" method="post">
            @method('POST')
            @csrf

            <div class="mb-3 w-100">
                <label for="name" class="form-label">Fullname</label>
                <input required type="text" name="name" class="form-control w-100" id="name"
                    aria-describedby="name">
            </div>
            <div class="mb-3 w-100">
                <label for="email" class="form-label">Email address</label>
                <input required type="email" name="email" class="form-control w-100" id="email"
                    aria-describedby="email">
            </div>
            <div class="mb-3 w-100">
                <label for="password" class="form-label">Password</label>
                <input required type="password" name="password" class="form-control w-100" id="password">
            </div>
            <div class="mb-3">
                <label for="profile" class="form-label">Photo Profile</label>
                <input required class="form-control" name="profile" type="file" id="profile">
            </div>
            <button class="btn w-100 btn-purple" type="submit">Register Now</button>
            <p class="mt-3 text-center">Have an account? <a style="text-decoration: none" class="fw-semibold"
                    href="/login">Login now</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
