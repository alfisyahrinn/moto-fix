@extends('admin.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <section id="booking">
        <div class="container mt-2">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h1-form-booking text-primary text-center">Booking Information</h1>
                            <div class="mt-4">
                                <div class="mb-4 row ml-4 mr-4">
                                    <label for="name" class="form-label col-md-3">Name</label>
                                    <input name="name" value="{{ $data->User->name }}" placeholder="Yamaha, Honda ..."
                                        type="text" class="form-control text-dark col-md-9" disabled id="name">
                                </div>
                                <div class="mb-4 row ml-4 mr-4">
                                    <label for="merk" class="form-label col-md-3">Merk</label>
                                    <input name="merk" value="{{ optional($data->Queue)->merk }}"
                                        placeholder="Yamaha, Honda ..." type="text"
                                        class="form-control text-dark col-md-9" disabled id="merk">
                                </div>
                                <div class="mb-4 row ml-4 mr-4">
                                    <label for="number_plate" class="form-label col-md-3">Number Plate</label>
                                    <input name="number_plate" value="{{ optional($data->Queue)->number_plate }}"
                                        placeholder="BL-351-GA" type="text" class="form-control text-dark col-md-9"
                                        disabled id="number_plate">
                                </div>
                                <div class="mb-4 row ml-4 mr-4">
                                    <label for="date" class="form-label col-md-3">Date</label>
                                     <input type="date" class="form-control col-md-3"
                                            value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d') }}" name="date"
                                            disabled id="date">
                                </div>
                                <div class="mb-4 row ml-4 mr-4">
                                    <label for="problem" class="form-label col-md-3">Problem</label>
                                    <textarea disabled class="form-control text-dark col-md-9 p-4" name="problem" id="problem" cols="30"
                                        rows="10">{{ optional($data->Queue)->problem }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <h1 class="h1-form-booking text-primary text-center">Transaction</h1>
                </div>

                <div class="col-12 mt-4">
                    <div class="col-12 mt-4">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                @if ($detail->product)
                                                    {{ $detail->product->name }}
                                                @elseif ($detail->service)
                                                    {{ $detail->service->name }}
                                                @else
                                                    Data not found
                                                @endif
                                            </td>
                                            <td>
                                                @if ($detail->product)
                                                    Rp.{{ number_format($detail->product->price, 0, ',', '.') }}
                                                @elseif ($detail->service)
                                                    Rp.{{ number_format($detail->service->price, 0, ',', '.') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.transactions.update_quantity', $detail->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="">
                                                        <input type="number" name="quantity"
                                                            value="{{ $detail->quantity }}" min="1"
                                                            class="form-control" style="width: 85px; text-align: center;"
                                                            @if ($paymentStatus === 'paid') disabled @endif>
                                                        <input type="hidden" name="detail_type"
                                                            value="{{ $detail->product_id ? 'product' : 'service' }}"
                                                            @if ($paymentStatus === 'paid') disabled @endif>
                                                        <br>
                                                        <button type="submit" class="btn btn-secondary"
                                                            @if ($paymentStatus === 'paid') disabled @endif>Update</button>
                                                    </div>
                                                </form>
                                            </td>



                                            <td class="text-center">
                                                <form id="deleteForm"
                                                    action="{{ route('details.delete', ['id' => $detail->id]) }}"
                                                    method="post" class="d-flex align-items-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="detail_type"
                                                        value="{{ $detail->product ? 'product' : 'service' }}">
                                                    <button type="button" onclick="confirmDelete('{{ $detail->id }}')"
                                                        class="btn btn-danger"
                                                        @if ($paymentStatus === 'paid') disabled @endif>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>







                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <ul class="list-group">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="#" class="list-group-item px-3 py-4 d-flex flex-column align-items-center"
                                    style="border: none"
                                    @if ($paymentStatus === 'paid') onclick="showAlert('Payment has been completed. Cannot add product.');" @else data-bs-toggle="modal" data-bs-target="#exampleModal" @endif>
                                    <i class="fas fa-plus-circle fa-2x m-auto" style="color: #005eff;"></i>
                                    <span class="mt-2">Add Product</span>
                                </a>
                            </div>

                            <div class="col-md-6 mb-3">
                                <a href="#" class="list-group-item px-3 py-4 d-flex flex-column align-items-center"
                                    style="border: none"
                                    @if ($paymentStatus === 'paid') onclick="showAlert('Payment has been completed. Cannot add service.');" @else data-bs-toggle="modal" data-bs-target="#addServiceModal" @endif>
                                    <i class="fas fa-plus-circle fa-2x m-auto" style="color: #005eff;"></i>
                                    <span class="mt-2">Add Service</span>
                                </a>
                            </div>
                        </div>

                        <li class="list-group-item px-3 py-4 d-flex justify-content-between total bg-primary">
                            <div class="d-flex align-items-center">
                                <p class="my-auto text-white mb-0">Total</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <h5 class="text-white mb-0">
                                    Rp.{{ number_format($data->total_price, 0, ',', '.') }}</h5>
                            </div>
                        </li>
                    </ul>

                    <script>
                        function showAlert(message) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: message,
                            });
                        }
                    </script>





                </div>
            </div>
        </div>


        <!-- Modal tambah barang -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product to Cart</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.transaction.addToCard', $data->id) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <input type="text" name="transaction_id" value="{{ $data->id }}" hidden>
                            <div class="mb-3">
                                <label for="product" class="form-label">Select Product</label>
                                <select class="form-select" name="product" aria-label="Select Product">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-product-exists="false">
                                            {{ $product->name }} -
                                            Rp.{{ number_format($product->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="addToCart" class="btn btn-primary">Add to
                                Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Modal tambah barang -->




        <!-- Modal tambah servis -->
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addServiceModalLabel">Add Service</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.transaction.addService', $data->id) }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <input type="text" name="transaction_id" value="{{ $data->id }}" hidden>
                            <div class="mb-3">
                                <label for="service" class="form-label">Select Service</label>
                                <select class="form-select" name="service" aria-label="Select Service">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }} - Rp.
                                            {{ number_format($service->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="addServiceToCart" class="btn btn-primary">Add
                                Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal tambah servis -->

        </div>
        </div>
        </div>
        <ul id="selectedItemsList" class="list-group">
            <!-- Daftar item yang dipilih akan ditampilkan di sini -->
        </ul>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addToCartBtn').click(function() {
                // let name = $('#itemSelect option:selected').text();
                // let price = $('#itemSelect option:selected').val();
                let name = $('#itemSelect option:selected #name').text();
                let price = $('#itemSelect option:selected #price').text();

                console.log({
                    name,
                    price,
                });

                if (name && price) {
                    let listItem = `<li class="list-group-item px-3 py-4 d-flex justify-content-between">
                                    <p class="my-auto">${name}</p>
                                    <h5>${price}</h5>
                                </li>`;
                    $('#selectedItemsList').append(listItem);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
@endsection
