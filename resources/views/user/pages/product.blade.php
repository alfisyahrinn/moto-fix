@extends('user.layout.app')
@section('content')
    <div class="mt-4">
        <h4>Sparepart yang tersedia</h4>
    </div>
    <div class="mt-3">
        <form class="d-flex" role="search" action="/product" method="get">
            <input class="form-control me-2" type="text" name="search"
                placeholder="cari informasi barang yang kamu butuhkan . . . ." value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">cari</button>
        </form>
    </div>
    <div class="container-fluid mt-3">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse rounded">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Supplier
                            </a>
                            <ul class="dropdown-menu">
                                   @foreach ($suppliers as $supplier)    
                                        <li><a class="dropdown-item" href="{{route('product.supplier', $supplier->id)}}">{{$supplier->name}}</a></li>
                                   @endforeach
                                
                            </ul>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Kategori
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $category)
                                    <li><a class="dropdown-item"
                                            href="{{ route('product.category', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}"><button type="submit"
                                            class="dropdown-item">Reset</button></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="card-hero-page3 row d-inline-flex gap-2">
                    @foreach ($products as $product)
                        <div class="card-items-hero-page3 col-lg-4 col-md-6 mb-2 bg-white"
                            onclick="window.location.href='{{ route('product.detail', $product->id) }}'">
                            <img src="{{ asset('storage/images/' . $product->image) }}" class="img-fluid"
                                alt="gambar-produk">
                            <a class="a-card-items-hero-page3">{{ $product->name }}</a>
                            <p class="desk-card-items-hero-page3">{{ $product->description }}</p>
                            <p class="price-card-items-hero-page3">Rp. {{ $product->price }}</p>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
@endsection
