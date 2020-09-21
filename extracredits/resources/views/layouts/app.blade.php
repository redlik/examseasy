<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Block search indeing -->
    <meta name="robots" content="noindex">

    <title>Exams Made Easy</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extra_scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    @yield('extra_styles')

</head>

<body class="d-flex flex-column h-100">
        <main role="main" style="padding-bottom: 40px">
        @include('partials/nav')

            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('partials/footer')
    @yield('bottom_scripts')
    
</body>

</html>
