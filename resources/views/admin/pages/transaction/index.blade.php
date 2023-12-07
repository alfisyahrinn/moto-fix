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
                                <td>
                                    @if ($data->Queue)
                                        {{ $data->Queue->no_queue }}
                                    @else
                                        Queue Deleted
                                    @endif
                                </td>
                                <td>{{ optional($data->Queue)->merk }}</td>
                                <td>{{ optional($data->Queue)->number_plate }}</td>
                                <td>{{ optional($data->Queue)->time }}</td>
                                <td>
                                    @if ($data->Queue && $data->Queue->transaction)
                                        <div class="alert p-0 text-center {{ $data->Queue->transaction->payment_status === 'paid' ? 'alert-success' : 'alert-danger' }}"
                                            role="alert">
                                            {{ $data->Queue->transaction->payment_status === 'paid' ? 'Paid' : 'Unpaid' }}
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>Rp.{{ number_format($data->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaction.edit', $data->id) }}" class="btn btn-success btn-circle">
                                        <i class="fas fa-pen-square"></i>
                                    </a>
                                    <form action="{{ route('transaction.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
