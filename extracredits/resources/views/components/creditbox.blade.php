<div>
    @auth
        @role('student')
        @if (Auth::user()->unlimited == 0)
        <div class="credit-box d-flex align-items-center"><div class="text-secondary text-small text-center">Credits <br/>remaining:</div><div class="credit-number">{{ Auth::user()->credits }}</div></div>
        @else
        <div class="credit-box d-flex align-items-center"><div class="unlimited text-center">UNLIMITED<br />ACCESS</div></div>
        @endif
        @endrole
    @endauth
</div>