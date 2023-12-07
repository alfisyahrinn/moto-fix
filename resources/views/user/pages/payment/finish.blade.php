<!-- resources/views/user/pages/payment/finish.blade.php -->

<<<<<<< HEAD
=======
<!-- resources/views/user/pages/payment/finish.blade.php -->

>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
@extends('user.layout.app')

@section('content')
 
    <div class="container mt-5 text-center">

        <div class="d-flex align-items-center justify-content-center flex-column">
            <img src="{{ asset('assets/img/check.png') }}" alt="Check Image" width="100" height="100">
            <br>
            <h4 class="alert-heading">Your payment was successful</h4>
<<<<<<< HEAD
            <p class="mb-0">Thank you for your payment. Your order ID is: {{ $orderId }}</p>
=======
            <p class="mb-0">Thank you for your payment. We will be in contact with more details shortly.</p>
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
        </div>

        <!-- Button for Success with Border Radius -->
        <a href="{{ route('user.index') }}" class="btn btn-success mt-3" style="border-radius: 20px;">
            <!-- You can add your image/icon here -->
            Continue
        </a>
    </div>
@endsection
