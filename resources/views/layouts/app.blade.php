<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>.: PPI RSHBM :.</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/img/report.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/custom.css') }}" rel="stylesheet">
    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script src="{{ url('/js/app.js') }}" defer></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
</head>

<body>
    @yield('content')
    {{-- <footer>
        &copy; 2023 IT Support, RSHBM.
    </footer> --}}

    {{-- @include('layouts.navbar') --}}
    {{-- @include('surveilans.add') --}}
    {{-- @include('rekapSurveilans.add') --}}
    {{-- @include('feedbackPPI.add') --}}
    {{-- @include('rekapCuciTangan.add') --}}
    {{-- @include('cuciTangan.add') --}}
</body>

</html>