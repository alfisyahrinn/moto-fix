@extends('admin.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <section id="booking" class="py-4">
        <div class="container">
            @csrf
            <div class="row">
                <div class="col-md-7 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h1-form-booking text-primary">Booking Information</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" value="{{ $data->User->name }}" placeholder="Yamaha, Honda ..."
                                        type="text" class="form-control text-dark" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="merk" class="form-label">Merk</label>
                                    <input name="merk" value="{{ $data->merk }}" placeholder="Yamaha, Honda ..."
                                        type="text" class="form-control text-dark" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="form-label">Number Plate</label>
                                    <input name="number_plate" value="{{ $data->number_plate }}" placeholder="BL-351-GA"
                                        type="text" class="form-control text-dark" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label">Date</label>
                                    <input type="date" class="form-control text-dark"
                                        value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d') }}" name="date"
                                        disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="permasalahan" class="form-label">Problem</label>
                                    <textarea disabled class="form-control text-dark p-4" name="problem" id="permasalahan" cols="30" rows="10">{{ $data->problem }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h1-form-booking text-primary">Status</h1>
                            <div class="mt-4">
                                <form action="{{ route('queue.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <input type="text" name="transaction_id" value="{{ $data->id }}" hidden>
                                        <select class="form-select" name="status" aria-label="Default select example"
                                            @if ($data->payment_status === 'paid') disabled @endif>
                                            <option value="1" {{ $data->status ? 'selected' : '' }}>Success</option>
                                            <option value="0" {{ !$data->status ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>

                                    @if ($data->payment_status !== 'paid')
                                        <button type="submit" class="btn btn-primary w-100"
                                            style="border-radius: 5px">Update</button>
                                    @else
                                        <!-- Display a message or icon indicating that the update is disabled -->
                                        <button class="btn btn-primary w-100" disabled>Update</button>
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul id="selectedItemsList" class="list-group">
            <!-- Daftar item yang dipilih akan ditampilkan di sini -->
        </ul>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addToCartBtn').click(function() {
                let name = $('#itemSelect option:selected #name').text();
                let price = $('#itemSelect option:selected #price').text();

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
