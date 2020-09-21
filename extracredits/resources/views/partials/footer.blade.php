<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 text-md-left text-center d-flex align-items-end">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-footer.svg') }}" alt="Extra Credits logo" style="height:40px;">
                </a>
                <span class="pt-1 text-secondary ml-4"> ©2020 <small>Built by <a href="https://collage.ie" style="color:#7f7f7f" target="_blank">Collage Creative</a></small></span>
            </div>
            <div class="col-md-6 col-12 text-md-right text-center mt-sm-4 mt-md-0">
                <ul class="nav justify-content-center footer-nav">
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/subjects">All Subjects</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('how-it-works') }}">How it works</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('contact') }}">Contact us</a>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
</footer>
