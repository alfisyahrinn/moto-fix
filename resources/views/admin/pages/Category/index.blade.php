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
                                <th class="col-1">No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>

                                        <!-- Button trigger modal for Edit -->
                                        <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                            data-target="#editModal{{ $data->id }}">
                                            <i class="fas fa-pen-square"></i>
                                        </button>

                                        <!-- Button trigger modal for delete confirmation -->
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
                                            data-target="#deleteModal{{ $data->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        @include('admin.pages.Category.delete')

                                        @include('admin.pages.Category.edit')
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

    @include('admin.pages.Category.add')


    </div>
@endsection
