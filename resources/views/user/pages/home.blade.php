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
@endsection
