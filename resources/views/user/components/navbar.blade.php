<nav class="navbar navbar-expand-md bg-white">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="{{ asset('assets/img/icon/logo.svg') }}" alt="moto-fix"
                width="42"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Service</a>
                    <li class="nav-item">
                        <a class="nav-link" href="#sparepart">Sparepart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color: blue">Sign In</a>
                    </li>
                </ul>
            </div>
    </div>
</nav>
