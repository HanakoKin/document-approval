<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}</title>
    {{-- <title>Dashboard</title> --}}

    @include('partials.head')

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    {{-- @if ($title === 'Dashboard') --}}
    {{-- <div id="loader"></div> --}}
    {{-- @endif --}}

    <div class="wrapper">

        <!-- Header -->
        @include('partials.header')

        <!-- SideBar -->
        @include('partials.sidebar')

        <!-- Main Content -->

        @include('modal.documents.compose')

        <div class="content-wrapper">
            <div class="container-full">
                @yield('container')
            </div>
        </div>

        <!-- Footer -->
        @include('partials.footer')

    </div>

    <!-- JS -->
    @include('partials.script')

</body>

</html>
