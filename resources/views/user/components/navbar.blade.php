<nav class="navbar navbar-expand-lg bg-transparent mt-2">
    <div class="container-fluid" style="padding-right: 85px; padding-left: 120px">

        <a class="navbar-brand" href="/"><img src="{{ asset('assets/img/icon/logo.svg') }}" alt="moto-fix"


       

                width="42"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex gap-5">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav gap-2">
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
                </ul>
            </div>
            <div>
                <a href="{{ route('login') }}" class="btn-signin-outline py-2 px-4">Sign In</a>
            </div>

        </div>
    </div>
</nav>
