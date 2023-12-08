<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">


<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1">
=======
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
>>>>>>> d442f62c90b86f15511fdd8e88e5004f02d8d509


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-7NcaQ+rDAqFty5PykL1LXdqFcYhB0j9THweqHLUa2J3RcRPtUx8XpSf9YPH6gHdjzzKr+MRK8RlJMb3+vQFbCg=="
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-LC9z57AO2eiTO2PvGO8XW6W4gY4ZOlFaGxW1OZLCA73bLdsTkqAW6F+ZrknUvyuI2wU9B6Iwsd7WqHRWTJqAQg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />




    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">

</head>

<body>
    @include('sweetalert::alert')
    <div>
        @guest
            @include('user.components.navbar')
        @endguest

        <!-- Main content -->
        <main class="py-4 container ">

            <!-- Include the authenticated user's navigation bar -->
            @auth
                @include('user.components.navbar-login')
            @endauth
            @yield('content')

        </main>


    </div>

</body>

</html>
