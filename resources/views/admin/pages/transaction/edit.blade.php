@extends('admin.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <section id="booking">
        <div>
            <div class="mt-2 px-4">
                @csrf
                <div class="row">
                    <div class="col-7">
                        <h1 class="h1-form-booking text-primary">Booking Information</h1>
                        <div class="mt-4">
                            <div class="mb-4">
                                <label for="merk" class="form-label">name</label>
                                <input name="merk" value="{{ $data->User->name }}" placeholder="Yamaha, Honda ..."
                                    type="text" class="form-control  text-dark w-75" disabled id="merk"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="merk" class="form-label">Merk</label>
                                <input name="merk" value="{{ $data->Queue->merk }}" placeholder="Yamaha, Honda ..."
                                    type="text" class="form-control  text-dark w-75" disabled id="merk"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="type" class="form-label">Number Plate</label>
                                <input name="number_plate" value="{{ $data->Queue->number_plate }}" placeholder="BL-351-GA"
                                    type="text" class="form-control text-dark w-75" disabled id="type"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="tanggal" class="form-label">Date</label>
                                <input type="date" class="form-control text-dark w-75"
                                    value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d') }}" name="date"
                                    disabled id="tanggal" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="permasalahan" class="form-label">Problem</label>
                                <textarea disabled class="form-control  text-dark w-75 p-4" name="problem" id="permasalahan" cols="30"
                                    rows="10">{{ $data->Queue->problem }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <h1 class="h1-form-booking text-primary">Transaksi</h1>
                        <div class="mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->Product->name }}</td>
                                            <td>Rp.{{ number_format($detail->Product->price, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    // Cek apakah item ada di dalam session
                                                    $cartItems = session('cartItems', []);
                                                    $cartItem = collect($cartItems)->firstWhere('id', $detail->id);
                                                    $quantity = $cartItem ? $cartItem['quantity'] : 1;
                                                @endphp

                                                <input type="text" id="quantity" name="quantity"
                                                    style="width: 50px; text-align: center; border: none;"
                                                    value="{{ $quantity }}" readonly>
                                            </td>
                                            <td>
                                                <form id="deleteForm_{{ $detail->id }}"
                                                    action="{{ route('admin.transaction.deleteItem', $detail->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete({{ $detail->id }})">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <ul class="list-group">
                                <li class="list-group-item px-3 py-4 d-flex justify-content-between" style="border: none">
                                    <i class="fas fa-plus-circle fa-2x m-auto" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" style="color: #005eff;"></i>
                                </li>
                                <li class="list-group-item px-3 py-4 d-flex justify-content-between total bg-light ">
                                    <p class="my-auto text-dark">Total</p>
                                    <h5 class="text-dark">Rp.{{ number_format($data->total_price, 0, ',', '.') }}</h5>
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
                        <div class="modal fade" id="exampleModalBayar" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- resources/views/purchase_form.blade.php -->
                                    <form action="{{ route('admin.transaction.addToCard', $data->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="text" name="transaction_id" value="{{ $data->id }}"
                                                hidden>
                                            <select class="form-select" name="product"
                                                aria-label="Default select example">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }} -
                                                        {{ ' ' }}Rp.{{ number_format($product->price, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="addToCart" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- Modal tambah barang -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(detailId) {
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
                    // Submit form when user confirms
                    document.getElementById('deleteForm_' + detailId).submit();
                }
            });
        }
    </script>
@endsection
