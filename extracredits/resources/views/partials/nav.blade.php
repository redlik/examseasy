<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <div class="d-none d-md-block">
                <img src="{{ asset('images/eme-logo.svg') }}" alt="Extra Credits logo" class="brand-logo">
            </div>
            <div class="d-sm-block d-md-none">
                <img src="{{ asset('images/logo-mobile.svg') }}" alt="Extra Credits logo" class="brand-logo" style="height: 70px">
            </div>
        </a>
        <div class="flex mx-auto">
                @yield('show_credits')
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/subjects">Subjects</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('paperadvice.index') }}">Exam Papers Advice</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('how-it-works') }}">How it Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('pricing') }}">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('about') }}">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('contact') }}">Contact us</a>
                </li>

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link btn btn-pink text-white ml-md-3"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @unlessrole('student')
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ url('/lesson/create') }}">Create new Lesson</a>
                        @else
                        <a class="dropdown-item" href="{{ route('buy_credits') }}">Buy Credits</a>
                        @if (Auth::user()->unlimited == 0)
                        <a class="dropdown-item" href="{{ route('pages.myvideos') }}">My Videos</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('user_panel', ['id' => Auth::user()->id]) }}">Student Dashboard</a>
                        @endunlessrole
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
