@extends('user.layout.app')

@section('content')
    {{-- Register-Style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/register-style.css') }}">
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
