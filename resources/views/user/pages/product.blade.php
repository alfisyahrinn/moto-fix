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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Supplier
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($suppliers as $supplier)
                                    <li><a class="dropdown-item"
                                            href="{{ route('product.supplier', $supplier->id) }}">{{ $supplier->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
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
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                    @foreach ($products as $product)
                        <div class="col mb-1" onclick="window.location.href='{{ route('product.detail', $product->id) }}'"
                            style="cursor: pointer;">
                            <div class="card h-100">
                                <div style="max-height: 250px; overflow:hidden;">

                                   <img src="{{ asset($product->image) }}" class="rounded img-fluid" style="width: 3000px; height: 300px" alt="{{ $product->name }} Image">




                                    <img src="{{asset('storage/'. $product->image)}}" class="card-img-top"
                                        alt="{{ $product->name }}">

                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::of($product->description)->limit(30) }}</p>
                                    <button type="button" class="btn btn-success" style="pointer-events:none">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>

            {{-- <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($products as $product)
                        <div class="card mb-2 bg-white" style="width: 18rem;"
                            onclick="window.location.href='{{ route('product.detail', $product->id) }}'">
                            <div style="max-width: 200px; overflow:hidden">
                                <img src="data:image/png;base64,{{ base64_encode($product->image) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="price-card-items-hero-page3">Rp. {{ $product->price }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main> --}}
        </div>
    </div>
@endsection
