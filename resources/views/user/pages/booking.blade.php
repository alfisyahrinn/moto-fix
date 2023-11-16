@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div>
                <a class="a-nav-booking-active me-4" aria-current="page" href="/">Booking</a>
                <a class="a-nav-booking" href="/booking">Jadwal</a>
            </div>
            {{-- <div>
                <h1 class="h1-booking">Booking Service Motor</h1>
                <p class="p-booking">perbaiki tanpa harus antri</p>
            </div> --}}
            <div class="mt-5">
                <form action="">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h1-form-booking">Booking Informasion</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">Merk</label>
                                    <input placeholder="Yamaha, Honda ..." type="text" class="form-control input-booking"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">Type</label>
                                    <input placeholder="Supra, beat" type="text" class="form-control input-booking"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">Waktu</label>
                                    <input type="text" class="form-control input-booking" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">Permasalahan</label>
                                    <textarea class="form-control input-booking p-4" name="permasalahan" id="floatingTextarea2" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h1 class="h1-form-booking">Personal Informasion</h1>
                            <div class="mt-4">
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">name</label>
                                    <input type="text" class="form-control input-booking" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">email</label>
                                    <input type="text" class="form-control input-booking" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label label-booking">No
                                        Handphone</label>
                                    <input type="text" class="form-control input-booking" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>

    </section>
@endsection
