@extends('layouts.app')

@section('content')
    {{-- Login-Style --}}
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">

    <div class="login-container">
        <div class="login-content">
            <div class="login-header">
                <div class="login-title">Sign In</div>
                <div class="login-subtitle">Masuk untuk melakukan Transaksi</div>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-field">
                        <label for="email" class="field-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="Your email address"
                            class="input-field">

                        <!-- Customize the error message for the email field -->
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="password" class="field-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Your password"
                            class="input-field">

                        <!-- Customize the error message for the password field -->
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="login-buttons">
                        <div class="button-container">
                            <button type="submit" class="button-background">
                                <div class="button-text">Continue to Sign In</div>
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="login-buttons">
                        <div class="button-container">
                            <a class="button-background-alt" href="{{ route('register') }}">
                                <div class="button-text-alt">Sign Up</div>
                            </a>
                        </div>
                    </div>


            </div>
            <div class="form-field">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
