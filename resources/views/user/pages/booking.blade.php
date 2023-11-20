@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div>
                <a class="a-nav-booking-active me-4" aria-current="page" href="/booking">Booking</a>
                <a class="a-nav-booking" href="/booking/jadwal">Jadwal</a>
            </div>

            <div class="mt-5">
                <form action="">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h1-form-booking">Booking Information</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="merk" class="form-label label-booking">Merk</label>
                                    <input placeholder="Yamaha, Honda ..." type="text" class="form-control input-booking"
                                        id="merk" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="form-label label-booking">Type</label>
                                    <input placeholder="Supra, Beat" type="text" class="form-control input-booking"
                                        id="type" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="tanggal" class="form-label label-booking">Tanggal</label>
                                    <input type="date" class="form-control input-booking" id="tanggal"
                                        aria-describedby="emailHelp">
                                </div>

                                <div class="mb-4">
                                    <label for="permasalahan" class="form-label label-booking">Permasalahan</label>
                                    <textarea class="form-control input-booking p-4" name="permasalahan" id="permasalahan" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h1 class="h1-form-booking">Personal Information</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="name" class="form-label label-booking">Name</label>
                                    <input type="text" class="form-control input-booking" id="name"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label label-booking">Email</label>
                                    <input type="text" class="form-control input-booking" id="email"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="form-label label-booking">No Handphone</label>
                                    <input type="text" class="form-control input-booking" id="phone"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add your submit button and form closing tags here -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-booking">Submit</button>
                        <a href="{{route('user.index')}}" class="btn btn-cancel" style="margin-left:150px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
