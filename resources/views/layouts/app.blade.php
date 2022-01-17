<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>

    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script type="text/javascript" charset="utf8" src="{{URL::asset('js/visualization.js')}}"></script>
    <script src="https://d3js.org/d3.v4.js"></script>
    <script src="https://d3js.org/topojson.v2.min.js"></script>

    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <style>
        .bar {
            fill: red;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link href="{{URL::asset('css/customcss.css')}}" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
{{--    <link href="{{ mix('css/custom') }}" rel="stylesheet">--}}


    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

</div>

<script src="{{ mix('js/app.js') }}" defer></script>

@yield('third_party_scripts')

@stack('page_scripts')
</body>
</html>
