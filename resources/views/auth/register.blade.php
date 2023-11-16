@extends('layouts.app')

@section('content')
    {{-- Register-Style --}}
    <link rel="stylesheet" href="{{ asset('css/register-style.css') }}">
    <div class="signup-container">
        <div class="signup-content">
            <div class="signup-header">
                <div class="signup-title">Sign Up</div>
                <div class="signup-subtitle">Daftar dan bergabung dengan kami</div>
            </div>
            <div class="signup-form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-field">
                        <label for="name" class="field-label">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Write your name"
                            class="input-field" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="email" class="field-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email address"
                            class="input-field" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="password" class="field-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Your password"
                            class="input-field">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-field">
                        <label for="password_confirmation" class="field-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Your password" class="input-field">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="signup-buttons">
                        <div class="button-container">
                            <button type="submit" class="button-background">
                                <div class="button-text">Continue</div>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="button-container">
                    <a class="button-background-alt" href="{{ route('login') }}">
                        <div class="button-text-alt">Sign In</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
