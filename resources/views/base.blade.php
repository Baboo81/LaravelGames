<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/styles/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/styles/user.css') }}">
    </head>

    <body>
        {{--NavBar--}}
        @include('navBar/navBar')

        {{--Les contenus seront affichés ici, les autres pages du site hériterons de cette page --}}
        @yield('content')

        {{--Footer--}}
        @include('footer/footer')

        {{--Scripts JS--}}
        @include('script')
    </body>
</html>
