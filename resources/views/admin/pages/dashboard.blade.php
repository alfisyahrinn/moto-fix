@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        <div class="row">
            <!-- Pending Queues Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center mr-2">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1 ml-3">
                                    Pending Queues </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ml-3">{{ $pendingQueues->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-gray-300"></i> <!-- Change to a suitable icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Transactions Card -->
            <div class="col-xl-3 col-md-6 mb-4 ml-5">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center mr-2">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-success text-uppercase mb-1 ml-3">
                                    Pending Transactions </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ml-3">{{ $pendingTransactions->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                <!-- Change to a suitable icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
