@extends('user.layout.app')

@section('content')
    <section id="hero">
        <div class="container mt-4">
            <div class="row align-items-center">
               <div class="col-lg-7 col-md-7">
    <h1 class="h1-hero">Atur waktu sesukanya tanpa Menunggu</h1>
    <p class="p-hero text-justify text-break">Kami menyediakan Service motor dan menjual berbagai sparepart motor</p>
    <a href="{{ route('booking.index') }}" class="btn-hero py-2 px-4">Booking Now</a>
</div>


                <div class="col-lg-5 col-md-5 mt-4">
                    <img src="{{ asset('assets/img/banner/hero-img.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="service" class="mt-7">
        <div class="container mt-4">
            <h1 class="h1-hero-page2 text-center">Layanan Servis Motor</h1>
            <div class="card-hero-page2 row justify-content-around">
                <div class="card-items-hero-page2 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <img src="{{ asset('assets/img/icon/service-kecil.png') }}" class="img-fluid" alt="" style="max-width: 100px">
                    <h1>Servis Kecil</h1>
                    <p>Paket servis ringan untuk menjaga performa motor Anda.</p>
                </div>
                <div class="card-items-hero-page2 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <img src="{{ asset('assets/img/icon/kelistrikan.png') }}" class="img-fluid" alt="" style="max-width: 100px">
                    <h1>Servis Sedang</h1>
                    <p>Servis menengah untuk pemeliharaan lebih detail.</p>
                </div>
                <div class="card-items-hero-page2 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <img src="{{ asset('assets/img/icon/service-besar.png') }}" class="img-fluid" alt="" style="max-width: 100px">
                    <h1>Servis Besar </h1>
                    <p>Paket servis menyeluruh untuk menjaga kesehatan motor Anda. </p>
                </div>
            </div>
        </div>
    </section>

    <section id="sparepart">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h1 class="h1-hero-page2">Sparepart Motor</h1>
                <a href="{{ route('product.display') }}" class="p-hero-page3 mt-auto">lihat semua</a>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4" onclick="window.location.href='{{ route('product.detail', $product->id) }}'" style="cursor: pointer;">
                        <div class="card h-100 w-80">
                            <div style="max-height: 250px; overflow:hidden;">
                                <img src="{{ asset($product->image) }}" class="rounded img-fluid" style="width: 3000px; height: 300px" alt="{{ $product->name }} Image">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text" style="margin-bottom: 10px;">{{ Str::of($product->description)->limit(40) }}</p>
<button type="button" class="btn btn-success" style="margin-top: 10px; pointer-events:none;">
    Rp{{ number_format($product->price, 0, ',', '.') }}
</button>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="about" style="background-color: #00a862; color: #ffffff;">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="h1-about" style="color:#ffffff">Tentang Kami</h1>
                    <p class="p-about" style="color:#ffffff">
                        Bengkel Motor Moto Fix adalah tempat terbaik untuk merawat dan memperbaiki sepeda motor Anda.
                        Dengan lokasi yang strategis di Jl. Ir. H. Juanda, Sidoarjo, Jawa Timur, kami menyediakan layanan
                        berkualitas tinggi
                        dan berbagai sparepart motor terbaik untuk memastikan kendaraan Anda tetap dalam kondisi prima.
                    </p>
                    <p class="p-about" style="color:#ffffff">
                        Kunjungi kami di:
                        <br>
                        Alamat Bengkel: Jl. Ir. H. Juanda, Sidoarjo, Jawa Timur
                        <br>
                        Telepon: -
                        <br>
                        Alamat Email: moto.fix@gmail.com
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
