@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex">
            <h1 class="h3 mb-4 text-gray-800 my-auto">{{ $title }}</h1>

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
                                <th>Id</th>
                                <th>Name</th>
                                <th>No Queue</th>
                                <th>Merk</th>
                                <th>Number</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->User->name }}</td>
                                    <td>{{ $data->no_queue }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->number_plate }}</td>
                                    <td>{{ $data->time }}</td>
                                    <td>
                                        <div class="alert p-0 text-center {{ $data->status === 1 ? 'alert-success' : 'alert-danger' }}"
                                            role="alert">
                                            {{ $data->status === 1 ? 'Success' : 'Pending' }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('queue.edit', $data->id) }}" class="btn btn-success btn-circle">
                                            <i class="fas fa-pen-square"></i>
                                        </a>

                                        {{-- <!-- Button trigger modal for delete confirmation -->
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
                                            data-target="#deleteModal{{ $data->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button> --}}

                                        <!-- Delete Confirmation Modal -->
                                        {{-- <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalLabel{{ $data->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">
                                                            Delete Confirmation</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this item?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('queue.destroy', $data->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
