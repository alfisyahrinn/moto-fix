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
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->User->name }}</td>
                                    <td>{{ $data->Queue->no_queue }}</td>
                                    <td>{{ $data->Queue->merk }}</td>
                                    <td>{{ $data->Queue->number_plate }}</td>
                                    <td>{{ $data->Queue->time }}</td>
                                    <td>
                                        {{-- @dd($data->status) --}}
                                        <div class="alert p-0 text-center {{ $data->status === '1' ? 'alert-success' : 'alert-danger' }}"
                                            role="alert">
                                            {{ $data->status === '1' ? 'Success' : 'Pending' }}
                                        </div>
                                    </td>
                                    <td>Rp.{{ number_format($data->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('transaction.edit', $data->id) }}"
                                            class="btn btn-success btn-circle">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
