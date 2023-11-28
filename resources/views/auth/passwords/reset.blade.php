@extends('admin.layouts.app')

@section('content')
    {{-- Reset Password-Style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/reset-style.css') }}">

    <div class="verification-container">
        <div class="verification-content">
            <div class="verification-header">
                <div class="verification-title">Reset Your Password</div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-field">
                            <label for="email" class="field-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="input-field @error('email') is-invalid @enderror"
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="password" class="field-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="input-field @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="password-confirm" class="field-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="input-field" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                        <br>
                        <div class="form-field">
                            <button type="submit" class="button-background">
                                <div class="button-text">{{ __('Reset Password') }}</div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
