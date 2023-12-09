@php
    $page = request()->segment(1);
@endphp

<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-purple shadow-custom">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold" href="/">RENT STUDIO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $page == '' ? 'fw-semibold active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'history' ? 'fw-semibold active' : '' }}" href="/history">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'review' ? 'fw-semibold active' : '' }}" href="/review">Review-mu</a>
                </li>
            </ul>
            <div class="d-flex dropdown" style="padding-right: 20px">
                <span role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    class="d-block rounded-circle nav-item"
                    style="background-size: cover; background-image: url('{{ Session::get('profile') }}'); width: 42px; height: 42px"></span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/profile/edit/1">Edit</a></li>
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
