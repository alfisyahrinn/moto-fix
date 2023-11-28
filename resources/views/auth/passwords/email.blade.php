@extends('admin.layouts.app')

@section('content')
    {{-- Email Send -Style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/email-style.css') }}">

    <div class="login-container">
        <div class="login-content">
            <div class="login-header">
                <div class="login-title">Reset Password</div>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-field">
                        <label for="email" class="field-label">Email Address</label>
                        <br>
                        <input id="email" type="email" class="input-field  @error('email') is-invalid @enderror"
                            placeholder="Enter your email address" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus>

                        <!-- Customize the error message for the email field -->
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <br>
                    <div class="login-buttons">
                        <div class="button-container">
                            <button type="submit" class="button-background">
                                <div class="button-text">Send Password Reset Link</div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
