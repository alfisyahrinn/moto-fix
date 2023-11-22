@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div class="mt-3">
                <a class="a-nav-booking me-4" aria-current="page" href="/booking">Booking</a>
                <a class="a-nav-booking-active" href="/booking/jadwal">Jadwal</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            <div class="row mt-5 gap-4">
                @foreach ($datas as $data)
                    <div class="col-3 {{ $data->status === 0 ? 'card-booking-active' : 'card-booking' }} text-center px-4">
                        <div class="{{ $data->status === 0 ? 'card-history-active' : 'card-history' }} d-flex">
                            <img class="m-auto img-booking"
                                src="{{ asset($data->status === 0 ? 'assets/img/icon/history-active.svg' : 'assets/img/icon/history.svg') }}"
                                alt="history  ">
                        </div>
                        <h1 class="{{ $data->status === 0 ? 'h1-card-booking-active' : 'h1-card-booking' }}">
                            {{ $data->no_queue }}</h1>
                        <p class=" {{ $data->status === 0 ? 'p-card-booking-active' : 'p-card-booking' }}">
                            {{ $data->problem }}</p>
                        <a href="{{ route('booking.show', $data->id) }}"
                            class="btn-hero py-2 px-4  {{ $data->status === 0 ? 'btn-card-booking' : '' }}">{{ $data->status === 0 ? $data->time : 'Selesai' }}</a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
