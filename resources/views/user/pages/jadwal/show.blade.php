@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div class="mt-5">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-7">
                            <h1 class="h1-form-booking">Booking Information</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="merk" class="form-label label-booking">Merk</label>
                                    <input name="merk" value="{{ $data->merk }}" placeholder="Yamaha, Honda ..."
                                        type="text" class="form-control input-booking  text-dark w-75" disabled
                                        id="merk" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="form-label label-booking">Number Plate</label>
                                    <input name="number_plate" value="{{ $data->number_plate }}" placeholder="BL-351-GA"
                                        type="text" class="form-control input-booking text-dark w-75" disabled
                                        id="type" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label label-booking">Date</label>
                                    <input type="date" class="form-control  input-booking text-dark w-75"
                                        value="{{ $data->time }}" name="date" disabled id="tanggal"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="permasalahan" class="form-label label-booking">Problem</label>
                                    <textarea disabled class="form-control  input-booking text-dark w-75 p-4" name="problem" id="permasalahan"
                                        cols="30" rows="10">{{ $data->problem }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <h1 class="h1-form-booking">Transaksi</h1>
                            <div class="mt-4">
                                <ul class="list-group">
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between">
                                        <p class="my-auto">Piston</p>
                                        <h5>RP.200.000</h5>
                                    </li>
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between">
                                        <p class="my-auto">Oli Federal</p>
                                        <h5>RP.50.000</h5>
                                    </li>
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between">
                                        <p class="my-auto">Filter Oli</p>
                                        <h5>RP.30.000</h5>
                                    </li>
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between total">
                                        <p class="my-auto text-light">Total</p>
                                        <h5 class="text-light">RP.280.000</h5>
                                    </li>
                                    <li class="list-group-item p-0 py-3" style="border: none">
                                        <button class="btn-booking p-0 w-100 " style="border-radius: 5px">Chekout</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Add your submit button and form closing tags here -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-booking">Submit</button>
                        <a href="{{ route('user.index') }}" class="btn btn-cancel" style="margin-left:150px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
