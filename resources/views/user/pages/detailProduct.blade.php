@extends('user.layout.app')
@section('content')
    <div class="mt-4">
        <h4><a href="{{url()->previous()}}"><i class="bi bi-arrow-left" style="color: black"></i>  </a>Detail Sparepart</h4>
    </div>
    <div class="container-fluid mt-3">
        <div class="row">  
            <div class="col-md-3 col-lg-4 d-md-block">
                <img src="{{asset('storage/images/'.$product->name)}}" alt="gambar-produk" style="width: 370px; heigt:370px">
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-8 px-md-4">
                <h4 class="">{{$product->name}}</h4>
                <h6 class="mt-3">Deskripsi barang</h6>
                <p class="">{{ $product->description }}</p>
                <p class="d-inline-flex gap-1">
                    <button type="button" class="btn btn-success" style="pointer-events:none">
                        Rp {{ $product->price }}
                    </button>
                    <button type="button" class="btn btn-success" style="pointer-events:none">
                        Stok : {{ $product->stock }}
                    </button>
                </p>
            </main>
            {{-- <img src="{{ asset('storage/images/' . $product->image) }}" class="img-fluid" alt="gambar-produk"> --}}
        </div>
    </div>
@endsection
