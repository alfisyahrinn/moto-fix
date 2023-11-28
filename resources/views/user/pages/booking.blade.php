@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div class="mt-3">
                <a class="a-nav-booking-active me-4" aria-current="page" href="/booking">Booking</a>
                <a class="a-nav-booking" href="/booking/jadwal">Jadwal</a>
            </div>
            @if (session('danger'))
                <div class="alert alert-danger mt-3">{{ session('danger') }}</div>
            @endif
            <div class="mt-5">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    {{-- <input type="text" hidden name="id_saya" value="{{ Auth::user()->id }}"> --}}
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h1-form-booking">Booking Information</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="merk" class="form-label label-booking">Merk</label>
                                    <input name="merk" value="{{ old('merk') }}" placeholder="Yamaha, Honda ..."
                                        type="text" class="form-control input-booking" id="merk"
                                        aria-describedby="emailHelp">
                                </div>
                                {{-- <div class="mb-4">
                                    <label for="type" class="form-label label-booking">Type</label>
                                    <input name="type" value="{{ old('type') }}" placeholder="Supra, Beat" type="text"
                                        class="form-control input-booking" id="type" aria-describedby="emailHelp">
                                </div> --}}
                                <div class="mb-4">
                                    <label for="type" class="form-label label-booking">Number Plate</label>
                                    <input name="number_plate" value="{{ old('number_plate') }}" placeholder="BL-351-GA"
                                        type="text" class="form-control input-booking" id="type"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label label-booking">Date</label>
                                    <input type="date" class="form-control input-booking" value="{{ old('name') }}"
                                        name="date" id="tanggal" aria-describedby="emailHelp">
                                </div>

                                <div class="mb-4">
                                    <label for="permasalahan" class="form-label label-booking">Problem</label>
                                    <textarea class="form-control input-booking p-4" name="problem" id="permasalahan" cols="30" rows="10">{{ old('problem') }}"</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h1 class="h1-form-booking">Personal Information</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="name" class="form-label label-booking">Name</label>
                                    <input name="name" type="text" class="form-control input-booking text-dark"
                                        disabled id="name" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label label-booking">Email</label>
                                    <input name="email" type="email" class="form-control input-booking text-dark"
                                        id="email" aria-describedby="emailHelp" disabled
                                        value="{{ Auth::user()->email }}">
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="form-label label-booking text-dark">No Handphone</label>
                                    <input name="no_handphone" type="text" class="form-control text-dark input-booking"
                                        id="phone" aria-describedby="emailHelp" disabled
                                        value="{{ Auth::user()->phone }}">
                                </div>
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
