@extends('user.layout.app')
@section('content')
    <div class="mt-4">
        <h4>Detail Sparepart</h4>
    </div>
    <div class="container-fluid mt-3">
        <div class="">
                @foreach ($products as $product)
                <a class="" href="">{{ $product->name }}</a>
                </br>
                <p class="">{{ $product->description }}</p>
                </br>
                <p class="">Rp. {{ $product->price }}</p>
                @endforeach
                {{-- <img src="{{ asset('storage/images/' . $product->image) }}" class="img-fluid" alt="gambar-produk"> --}}
        </div>
    </div>
@endsection
