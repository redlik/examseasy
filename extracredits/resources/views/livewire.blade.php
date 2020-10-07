@extends('layouts.app')

@section('extra_styles')
    @livewireStyles
@endsection

@section('content')
    <livewire:lessons>
@endsection


@section('bottom_scripts')
    @livewireScripts
@endsection