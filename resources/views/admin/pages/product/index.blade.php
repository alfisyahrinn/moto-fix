@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex">
            <h1 class="h3 mb-4 text-gray-800 my-auto">{{ $title }}</h1>
            <button class="btn btn-primary btn-icon-split ms-auto mb-auto" data-bs-toggle="modal" data-bs-target="#addModal">
                <span><i class="fas fa-plus-square"></i></span>
                <span class="text">Add</span>
            </button>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->supplier->name }}</td>
                                    <td>{{ $product->description }}</td>
<<<<<<< HEAD
                                     <td class="text-center">
            <img src="{{ asset($product->image) }}" class="rounded" style="width: 150px; height: 150px" alt="{{ $product->name }} Image">
        </td>
=======
                                    <td class="text-center">
                                        <img src="{{asset('storage/'. $product->image)}}" class="rounded" style="width: 150px; height:150px">
                                    </td>
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
                                    <td>{{ $product->stock }}</td>
                                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>

                                        <!-- Button trigger modal for Edit -->
                                        <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                            data-target="#editModal{{ $product->id }}">
                                            <i class="fas fa-pen-square"></i>
                                        </button>
                                        
                                        <!-- Button trigger modal for delete confirmation -->
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
                                            data-target="#deleteModal{{ $product->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        @include('admin.pages.product.delete')
                                        
                                        @include('admin.pages.product.edit')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('admin.pages.product.add')
    
    
    </div>
@endsection