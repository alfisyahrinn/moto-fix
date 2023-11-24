@extends('admin.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <section id="booking">
        <div>
            <div class="mt-2 px-4">
                <form action="{{ route('booking.store') }}" method="POST">
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
                                    <input name="merk" value="{{ $data->merk }}" placeholder="Yamaha, Honda ..."
                                        type="text" class="form-control  text-dark w-75" disabled id="merk"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="form-label">Number Plate</label>
                                    <input name="number_plate" value="{{ $data->number_plate }}" placeholder="BL-351-GA"
                                        type="text" class="form-control text-dark w-75" disabled id="type"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label">Date</label>
                                    <input type="date" class="form-control  text-dark w-75" value="{{ $data->time }}"
                                        name="date" disabled id="tanggal" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="permasalahan" class="form-label">Problem</label>
                                    <textarea disabled class="form-control  text-dark w-75 p-4" name="problem" id="permasalahan" cols="30"
                                        rows="10">{{ $data->problem }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <h1 class="h1-form-booking text-primary">Transaksi</h1>
                            <div class="mt-4">
                                <ul class="list-group">
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between"
                                        style="border: none">
                                        <i class="fas fa-plus-circle fa-2x m-auto" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" style="color: #005eff;"></i>
                                    </li>
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between total bg-light ">
                                        <p class="my-auto text-dark">Total</p>
                                        <h5 class="text-dark">RP.280.000</h5>
                                    </li>
                                    <li class="list-group-item p-0 py-3" style="border: none">
                                        <button class="btn btn-primary w-100 " style="border-radius: 5px">Upload</button>
                                    </li>
                                </ul>
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
                                        <div class="modal-body">
                                            <select class="form-select" id="itemSelect" aria-label="Default select example">
                                                <option value="1">
                                                    <span id="name">Kampas Rem</span>
                                                    <span id="price">100000</span>
                                                </option>
                                                <option value="2">
                                                    <p id="name">Federal Oil</p>
                                                    <p id="price">100000</p>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="addToCartBtn" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
@endsection
