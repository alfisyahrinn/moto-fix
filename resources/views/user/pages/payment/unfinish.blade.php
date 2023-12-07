<!-- resources/views/user/pages/payment/unfinish.blade.php -->

@extends('user.layout.app')

@section('content')
    <div class="container mt-5 text-center">

        <div class="d-flex align-items-center justify-content-center flex-column">
            <img src="{{ asset('assets/img/cross.png') }}" alt="Cross Image" width="100" height="100">
            <br>
            <h4 class="alert-heading">Payment Unsuccessful</h4>
            <p class="mb-0">We encountered an issue with your payment. Please try again or contact support.</p>
        </div>

        <!-- Button to Retry -->
        <a href="{{ route('booking.index') }}" class="btn btn-danger mt-3" style="border-radius: 20px;">
            <!-- You can add your image/icon here -->
            Retry Payment
        </a>
    </div>
@endsection

