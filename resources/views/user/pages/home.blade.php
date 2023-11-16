@extends('user.layout.app')
@section('content')
    <section class="hero">
        <div class="mt-4">
            <div class="row align-items-center">
                <div class="col-7">
                    <h1 class="h1-hero">Atur waktu sesukanya tanpa Menunggu</h1>
                    <p class="p-hero">Kami menyediakan Service motor dan menjual berbagai sparepart motor</p>
                    <button class="btn-hero py-2 px-4">Booking Now</button>
                </div>
                <div class="col-5">
                    <img src="{{ asset('assets/img/banner/hero-img.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="hero-page2">
        <div style="margin-top: 100px">
            <h1 class="h1-hero-page2 text-center">Masalah masalah <br> dalam Motor</h1>
            <div class="card-hero-page2 d-flex justify-content-between">
                <div class="card-items-hero-page2">
                    <img src="{{ asset('assets/img/banner/kelistrikan.png') }}" alt="">
                    <h1>Kelistrikan</h1>
                    <p>Lampu tidak hidup maupun hazard tidak bisa</p>
                </div>
                <div class="card-items-hero-page2">
                    <img src="{{ asset('assets/img/banner/kelistrikan.png') }}" alt="">
                    <h1>Kelistrikan</h1>
                    <p>Lampu tidak hidup maupun hazard tidak bisa</p>
                </div>
                <div class="card-items-hero-page2">
                    <img src="{{ asset('assets/img/banner/kelistrikan.png') }}" alt="">
                    <h1>Kelistrikan</h1>
                    <p>Lampu tidak hidup maupun hazard tidak bisa</p>
                </div>
            </div>
        </div>
    </section>
    <section class="hero-page3">
        <div style="margin-top: 100px">
            <div class="d-flex justify-content-between">
                <h1 class="h1-hero-page3">Sparepart Motor</h1>
                <a href="#" class="p-hero-page3 mt-auto">lihat semua</a>
            </div>
            <div class="card-hero-page3 mt-5 d-flex gap-2">
                @for ($i = 0; $i < 6; $i++)
                    <div class="card-items-hero-page3">
                        <img src="{{ asset('assets/img/banner/piston-karisma.png') }}" alt="piston-karisma">
                        <a class="a-card-items-hero-page3">Piston Supra x 125 old , karisma </a>
                        <p class="desk-card-items-hero-page3">Piston Merek Astra honda motor (AHM) size 32mm</p>
                        <p class="price-card-items-hero-page3">Rp. 155.000</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
