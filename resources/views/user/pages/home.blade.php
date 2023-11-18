@extends('user.layout.app')
@section('content')
    <section id="hero">
        <div class="container mt-4">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="h1-hero">Atur waktu sesukanya tanpa Menunggu</h1>
                    <p class="p-hero">Kami menyediakan Service motor dan menjual berbagai sparepart motor</p>
                    <a href="{{ route('user.index') }}" class="btn-hero py-2 px-4">Booking Now</a>
                </div>

                <div class="col-lg-5">
                    <img src="{{ asset('assets/img/banner/hero-img.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="service" class="mt-7">
        <div class="container mt-4">
            <h1 class="h1-hero-page2 text-center">Masalah masalah <br> dalam Motor</h1>
            <div class="card-hero-page2 row justify-content-around">
                <div class="card-items-hero-page2 col-md-4">
                    <img src="{{ asset('assets/img/banner/kelistrikan.png') }}" class="img-fluid" alt="">
                    <h1>Kelistrikan</h1>
                    <p>Lampu tidak hidup maupun hazard tidak bisa</p>
                </div>
                <div class="card-items-hero-page2 col-md-4">
                    <img src="{{ asset('assets/img/banner/kelistrikan.png') }}" class="img-fluid" alt="">
                    <h1>Kelistrikan</h1>
                    <p>Lampu tidak hidup maupun hazard tidak bisa</p>
                </div>
                <div class="card-items-hero-page2 col-md-4">
                    <img src="{{ asset('assets/img/banner/kelistrikan.png') }}" class="img-fluid" alt="">
                    <h1>Kelistrikan</h1>
                    <p>Lampu tidak hidup maupun hazard tidak bisa</p>
                </div>
            </div>
        </div>
    </section>

    <section id="sparepart">
        <div class="container mt-4">
            <div class="d-flex justify-content-between">
                <h1 class="h1-hero-page3">Sparepart Motor</h1>
                <a href="{{route('user.index')}}" class="p-hero-page3 mt-auto">lihat semua</a>
            </div>
            <div class="card-hero-page3 mt-4 row justify-content-around">
                @for ($i = 0; $i < 6; $i++)
                    <div class="card-items-hero-page3 col-lg-4 col-md-6">
                        <img src="{{ asset('assets/img/banner/piston.png') }}" class="img-fluid" alt="piston-karisma">
                        <a class="a-card-items-hero-page3">Piston Supra x 125 old , karisma </a>
                        <p class="desk-card-items-hero-page3">Piston Merek Astra honda motor (AHM) size 32mm</p>
                        <p class="price-card-items-hero-page3">Rp. 155.000</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="h1-about">Tentang Kami</h1>
                    <p class="p-about">
                        Bengkel Motor XYZ adalah tempat terbaik untuk merawat dan memperbaiki sepeda motor Anda.
                        Dengan lokasi yang strategis di [Alamat Bengkel], kami menyediakan layanan berkualitas tinggi
                        dan berbagai sparepart motor terbaik untuk memastikan kendaraan Anda tetap dalam kondisi prima.
                    </p>
                    <p class="p-about">
                        Kunjungi kami di:
                        <br>
                        [Alamat Bengkel]
                        <br>
                        Telepon: [Nomor Telepon]
                        <br>
                        Email: [Alamat Email]
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
