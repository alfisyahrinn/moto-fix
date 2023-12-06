@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

        <div class="row">
            <!-- Pending Queues Card -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-2 ml-3">
                                    Pending Queues
                                </div>
                                <div class="h4 font-weight-bold text-gray-800 ml-3">
                                    {{ $pendingQueues->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-3x text-gray-300 mr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Transactions Card -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-success shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-md font-weight-bold text-success text-uppercase mb-2 ml-3">
                                    Pending Transactions
                                </div>
                                <div class="h4 font-weight-bold text-gray-800 ml-3">
                                    {{ $unpaidTransactions->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-3x text-gray-300 mr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Total Categories Card -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-md font-weight-bold text-warning text-uppercase mb-2 ml-3">
                                    Total Categories
                                </div>
                                <div class="h4 font-weight-bold text-gray-800 ml-3">
                                    {{ $categoryCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-layer-group fa-3x text-gray-300 mr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Suppliers Card -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-md font-weight-bold text-danger text-uppercase mb-2 ml-3">
                                    Total Suppliers
                                </div>
                                <div class="h4 font-weight-bold text-gray-800 ml-3">
                                    {{ $supplierCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck fa-3x text-gray-300 mr-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Products Card -->
        <div class="col-md-13 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-md font-weight-bold text-success text-uppercase mb-2 ml-3">
                                Total Products
                            </div>
                            <div class="h4 font-weight-bold text-gray-800 ml-3">
                                {{ $totalProductCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-3x text-gray-300 mr-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Chart Card -->
        <div class="row">
            <div class="col-xl mb-4">
                <div class="card border-left-info shadow h-100">
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="revenueChart" style="height: 400px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('revenueChart').getContext('2d');

            var gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(75, 192, 192, 0.1)');
            gradient.addColorStop(1, 'rgba(75, 192, 192, 0.8)');

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($paidTransactions->pluck('date')),
                    datasets: [{
                        label: 'Daily Revenue',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        data: @json($paidTransactions->pluck('total')),
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                            },
                            grid: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    return '$' + value;
                                }
                            }
                        }
                    },
                    elements: {
                        line: {
                            tension: 0
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        zoom: {
                            pan: {
                                enabled: true,
                                mode: 'x',
                            },
                            zoom: {
                                enabled: true,
                                mode: 'x',
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
