@extends('user.layout.app')

@section('content')
    {{-- Verify-Style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/verify-style.css') }}">
    <div class="verification-container">
        <div class="verification-content text-center">
            <div class="verification-header">
                <div class="verification-title">Verify Your Email Address</div>
                <div class="verification-subtitle">Before proceeding, please check your email for a verification link.</div>
            </div>

            <div class="card">
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    <p class="lead">
                        If you did not receive the email, click the button below to request another:
                    </p>

                    <div class="verification-buttons">
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="button-container">
                                <button type="submit" class="button-background">
                                    <div class="button-text">Request Verification Link</div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
