@extends('layouts.app')

@section('extra_styles')
    @livewireStyles
@endsection

@section('show_credits')
    @auth
        @role('student')
        <div class="credit-box d-flex align-items-center"><div class="text-secondary text-small text-center">Credits <br/>remaining:</div><div class="credit-number">{{ Auth::user()->credits }}</div></div>
        @endrole
    @endauth
@endsection

@section('content')
@guest
<div class="d-flex align-items-center align-content-center">
    <h2>You are not authorised to view this page.</h2>  
</div>
@endguest
@role('student')
<div class="col-12 bg-white rounded shadow-sm p-2 p-4">
    <h1 class="text-uppercase font-weight-black text-center mb-3">Your unlocked videos</h1>

    <div class="row">
        <livewire:lessons>
    </div>
</div>
@endrole
@endsection

@section('bottom_scripts')
    @livewireScripts
@endsection
