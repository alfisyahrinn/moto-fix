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
                        <h1 class="h1-form-booking text-primary">Status</h1>
                        <div class="mt-4">
                            <form action="{{ route('queue.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <input type="text" name="transaction_id" value="{{ $data->id }}" hidden>
                                    <select
                                        class="form-select {{ $data->status === 0 ? 'border-danger' : 'border-success' }}"
                                        name="product" aria-label="Default select example">
                                        <option value="{{ $data->status }}">{{ $data->status }}</option>
                                        <option value="{{ $data->status === 1 ? '0' : '1' }}">
                                            {{ $data->status === 1 ? '0' : '1' }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" style="border-radius: 5px"
                                    data-bs-toggle="modal" data-bs-target="#exampleModalBayar">Update</button>
                            </form>
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
@endsection
