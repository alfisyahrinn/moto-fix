<!-- resources/views/user/pages/payment/error.blade.php -->

@extends('user.layout.app')

@section('content')
    <div class="container mt-5 text-center">

        <div class="d-flex align-items-center justify-content-center flex-column">
            <img src="{{ asset('assets/img/error.png') }}" alt="Error Image" width="100" height="100">
            <br>
            <h4 class="alert-heading">Oops! Something went wrong</h4>
            <p class="mb-0">We apologize for the inconvenience. Please try again later or contact support.</p>
        </div>

        <!-- Button to Redirect to Booking -->
        <a href="{{ route('booking.index') }}" class="btn btn-danger mt-3" style="border-radius: 20px;">
            <!-- You can add your image/icon here -->
            Go to Booking
        </a>
    </div>
@endsection
