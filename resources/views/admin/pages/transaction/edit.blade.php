@extends('admin.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <section id="booking">

        <div>
            <div class="mt-2 px-4">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="h1-form-booking text-primary text-center">Booking Information</h1>
                                <div class="mt-4">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input name="name" value="{{ $data->User->name }}"
                                            placeholder="Yamaha, Honda ..." type="text"
                                            class="form-control  text-dark w-75 mx-auto" disabled id="name">
                                    </div>
                                    <div class="mb-4">
                                        <label for="merk" class="form-label">Merk</label>
                                        <input name="merk" value="{{ $data->Queue->merk }}"
                                            placeholder="Yamaha, Honda ..." type="text"
                                            class="form-control  text-dark w-75 mx-auto" disabled id="merk">
                                    </div>
                                    <div class="mb-4">
                                        <label for="number_plate" class="form-label">Number Plate</label>
                                        <input name="number_plate" value="{{ $data->Queue->number_plate }}"
                                            placeholder="BL-351-GA" type="text"
                                            class="form-control text-dark w-75 mx-auto" disabled id="number_plate">
                                    </div>
                                    <div class="mb-4">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control text-dark w-75 mx-auto"
                                            value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d') }}" name="date"
                                            disabled id="date">
                                    </div>
                                    <div class="mb-4">
                                        <label for="problem" class="form-label">Problem</label>
                                        <textarea disabled class="form-control text-dark w-75 mx-auto p-4" name="problem" id="problem" cols="30"
                                            rows="10">{{ $data->Queue->problem }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-5">
                        <h1 class="h1-form-booking text-primary">Transaksi</h1>
                        <div class="mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"> Name</th>
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

                                            <!-- Kolom untuk mengupdate kuantitas -->
                                            <td>
                                                <form
                                                    action="{{ route('admin.transactions.update_quantity', $detail->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Input quantity -->
                                                    <div class="">
                                                        <input type="number" name="quantity"
                                                            value="{{ $detail->quantity }}" min="1"
                                                            class="form-control" style="width: 80px; text-align: center;">
                                                    </div>
                                                    <!-- Tombol Update -->
                                                    <button type="submit" class="btn btn-dark mt-3"
                                                        style="background: #FFFFFF; border-radius: 0px; color: #EE4D2D; border-color: #EE4D2D; border: 1px solid #EE4D2D;">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>

                                            <td>
                                                <form id="deleteForm"
                                                    action="{{ route('details.delete', ['id' => $detail->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    @if ($detail->product)
                                                        <input type="hidden" name="detail_type" value="product">
                                                    @elseif ($detail->service)
                                                        <input type="hidden" name="detail_type" value="service">
                                                    @endif

                                                    <button type="button" onclick="confirmDelete()"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>


                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <ul class="list-group">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <a href="#"
                                            class="list-group-item px-3 py-4 d-flex flex-column align-items-center"
                                            style="border: none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fas fa-plus-circle fa-2x m-auto" style="color: #005eff;"></i>
                                            <span class="mt-2">Add Product</span>
                                        </a>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <a href="#"
                                            class="list-group-item px-3 py-4 d-flex flex-column align-items-center"
                                            style="border: none" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                            <i class="fas fa-plus-circle fa-2x m-auto" style="color: #005eff;"></i>
                                            <span class="mt-2">Add Service</span>
                                        </a>
                                    </div>
                                </div>

                                <li class="list-group-item px-3 py-4 d-flex justify-content-between total bg-light">
                                    <div class="d-flex align-items-center">
                                        <p class="my-auto text-dark mb-0">Total</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h5 class="text-dark mb-0">Rp.{{ number_format($data->total_price, 0, ',', '.') }}
                                        </h5>
                                    </div>
                                </li>


                                <li class="list-group-item p-0 py-3" style="border: none">
                                    <button type="submit"
                                        class="btn btn-primary w-100 {{ $data->Queue->status === 0 ? 'btn-secondary' : '' }}"
                                        style="border-radius: 5px" data-bs-toggle="modal"
                                        {{ $data->Queue->status === 0 ? 'disabled' : '' }}
                                        data-bs-target="#exampleModalBayar">
                                        <i class="fas fa-times"></i> Bayar
                                    </button>
                                </li>
                            </ul>


                        </div>
                        {{-- Modal Bayar --}}
                        <div class="modal fade" id="exampleModalBayar" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('transaction.update', $data->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="payment_method" value="cash">

                                            <input type="text" name="transaction_id" value="{{ $data->id }}"
                                                hidden>
                                            <input type="text" name="uang_cek" value="" id="iniBayar" hidden>
                                            <div class="row">
                                                <div class="col-6 mb-4">
                                                    <label for="type" class="form-label">Total</label>
                                                    <input name="number_plate"
                                                        value="{{ number_format($data->total_price, 0, ',', '.') }}"
                                                        placeholder="BL-351-GA" type="text"
                                                        class="form-control text-dark py-4" disabled id="type"
                                                        aria-describedby="emailHelp">
                                                </div>
                                                <div class="col-6 mb-4">
                                                    <label for="number" class="form-label">Money</label>
                                                    <input name="money" value="" type="text"
                                                        class="form-control text-dark py-4" id="moneyInput">
                                                </div>
                                                <div class="text-center">
                                                    <label for="type" class="form-label">Back</label>
                                                    <input name="number_plate" type="text"
                                                        class="form-control text-dark text-center py-4" disabled
                                                        id="backInput" aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="done" disabled
                                                class="btn btn-primary">Done</button>
                                        </div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                // Mendapatkan nilai total dari PHP ke JavaScript
                                                const totalValue = {{ $data->total_price }};

                                                // Event listener ketika input 'Money' berubah
                                                $('#moneyInput').on('input', function() {
                                                    // Ambil nilai uang yang dimasukkan
                                                    const money = parseFloat($(this).val().replace(/[^\d.-]/g, '')) || 0;
                                                    console.log(money);
                                                    if (money < totalValue) {
                                                        $(this).addClass('border-danger');
                                                    } else {
                                                        // $(this).removeClass('border-danger');
                                                        $(this).addClass('border-success');
                                                    }
                                                    if (money < totalValue) {
                                                        $('#done').prop('disabled', true); // Menonaktifkan tombol jika nilai < 1
                                                        // $(this).addClass('border-danger');
                                                    } else {
                                                        $('#done').prop('disabled', false); // Mengaktifkan tombol jika nilai >= 1
                                                        // $(this).removeClass('border-danger');
                                                    }
                                                    // $(this).val(formatCurrency(money));
                                                    // Hitung kembalian
                                                    const back = money - totalValue;

                                                    // Tampilkan kembalian dengan format mata uang
                                                    $('#iniBayar').val(money);
                                                    $('#backInput').val(formatCurrency(back));
                                                });

                                                // Fungsi untuk memformat nilai ke mata uang Rupiah
                                                function formatCurrency(value) {
                                                    return new Intl.NumberFormat('id-ID', {
                                                        style: 'currency',
                                                        currency: 'IDR'
                                                    }).format(value);
                                                }
                                            });
                                        </script>

                                    </form>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.transaction.addToCard', $data->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="text" name="transaction_id" value="{{ $data->id }}"
                                                hidden>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="addToCart" class="btn btn-primary">Add to
                                                Cart</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal tambah barang -->




                        <!-- Modal tambah servis -->
                        <div class="modal fade" id="addServiceModal" tabindex="-1"
                            aria-labelledby="addServiceModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addServiceModalLabel">Add Service</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.transaction.addService', $data->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="text" name="transaction_id" value="{{ $data->id }}"
                                                hidden>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
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
