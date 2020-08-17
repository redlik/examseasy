<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

</head>

<body>
    <div id="app">
        @include('partials/nav')

        <main class="py-4">
            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <footer>

    </footer>
    @yield('bottom_scripts')
    
</body>

</html>
