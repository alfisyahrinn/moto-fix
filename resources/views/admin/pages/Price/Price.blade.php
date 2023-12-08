
@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex">
        <h1 class="h3 mb-4 text-gray-800 my-auto">{{ $title }}</h1>


        <button type="button" class="btn btn-primary btn-icon-split ms-auto mb-auto" data-bs-toggle="modal" data-bs-target="#ModalCreate">
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
                            <th>Price</th>
                            <th colspan="2">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0 @endphp
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $data->name }}</td>
                                <td> {{ $data->price }} </td>
                                <td class=" d-flex justify-content">

                                    <!-- Button trigger modal for Edit -->
                                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal"
                                        data-target="#EditModal{{ $data->id }}">
                                        <i class="fas fa-pen-square"></i>
                                    </button>



                                    <!-- Button trigger modal for delete confirmation -->
                                   <form  action="/admin/price/{{ $data->id }}" method="POST" type="button"  onsubmit="return confirm('are you sure ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-circle"> <i class="fas fa-trash">
                                        </i> </button>

                                     </form>
                                </td>
                            </tr>

                            @include('admin.pages.price.editprice')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('admin.pages.price.addprice')


</div>
@endsection
