@php
    $page = request()->segment(2);
@endphp

<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-purple shadow-custom">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold" href="/admin">RENT STUDIO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $page == '' ? 'fw-semibold active' : '' }}" aria-current="page"
                        href="/admin">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'studio' ? 'fw-semibold active' : '' }}"
                        href="/admin/studio">Studio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'payment' ? 'fw-semibold active' : '' }}"
                        href="/admin/payment">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'review' ? 'fw-semibold active' : '' }}"
                        href="/admin/review">Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'account' ? 'fw-semibold active' : '' }}"
                        href="/admin/account">Account</a>
                </li>
            </ul>
            <div class="d-flex dropdown" style="padding-right: 20px">
                <p role="button" data-bs-toggle="dropdown" aria-expanded="false" class="d-block nav-item">
                    Selamat datang, <b>Admin</b>
                </p>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>

        </div>
    </div>
</nav>
