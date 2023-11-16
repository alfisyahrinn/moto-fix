@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div>
                <a class="a-nav-booking me-4" aria-current="page" href="/booking">Booking</a>
                <a class="a-nav-booking-active" href="/booking/jadwal">Jadwal</a>
            </div>
            <div class="row mt-5 gap-4">
                @for ($i = 0; $i < 7; $i++)
                    <div class="col-3 card-booking-active text-center px-4">
                        <div class="card-history-active d-flex">
                            <img class="m-auto img-booking" src="{{ asset('assets/img/icon/history-active.svg') }}"
                                alt="history  ">
                        </div>
                        <h1 class="h1-card-booking-active">DAS242</h1>
                        <p class="p-card-booking-active">Kerusakann pada mesin bunyi-bunyi</p>
                        <button class="btn-hero py-2 px-4 btn-card-booking">1 day left</button>
                    </div>
                    <div class="col-3 card-booking text-center px-4">
                        <div class="card-history d-flex">
                            <img class="m-auto" src="{{ asset('assets/img/icon/history.svg') }}" alt="history  ">
                        </div>
                        <h1 class="h1-card-booking">DAS242</h1>
                        <p class="p-card-booking">Kerusakann pada mesin bunyi-bunyi</p>
                        <button class="btn-hero py-2 px-4">Selesai</button>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
