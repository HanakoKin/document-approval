<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title> {{ $title }} </title>

    @include('partials.head')

</head>

<body class="hold-transition theme-primary bg-img"
    style="background-image: url({{ asset('assets/images/auth-bg/bg-1.jpg') }})">


    <div class="container-fluid">

        <!-- Main Content -->
        <main class="d-flex justify-content-center">
            @yield('container')
        </main>

    </div>

    {{-- <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            @yield('container')

        </div>
    </div> --}}


    @include('partials.script')

</body>

</html>
