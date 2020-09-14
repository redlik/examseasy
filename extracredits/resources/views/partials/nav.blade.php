<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/eme-logo.svg') }}" alt="Extra Credits logo" class="brand-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mx-auto">
                @yield('show_credits')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}">Home</a>
                </li>
                
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('subjectsView') }}">All Lessons</a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Subjects <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('subjects-view', ['irish']) }}">Irish</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['english']) }}">English</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['history']) }}">History</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['geography']) }}">Geography</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['biology']) }}">Biology</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['accounting']) }}">Accounting</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['business']) }}">Business</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['economics']) }}">Economics</a>
                        <a class="dropdown-item" href="{{ route('subjects-view', ['construction']) }}">Construction</a>
                    </div>
                </li>
                <!--  Authentication Links -->

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('pricing') }}">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('testimonials') }}">Testimonials</a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('how-it-works') }}">How it Works</a>
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
                        <a class="dropdown-item" href="">My Videos</a>
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
