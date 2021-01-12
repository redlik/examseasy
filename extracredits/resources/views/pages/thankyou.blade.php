@extends('layouts.app')

@section('show_credits')
    <x-creditbox />
@endsection

@section('content')
    <div class="col-12">
        <div class="col-12 mb-4">
            <h1 class="text-center main-heading display-3 mb-3">Thank you</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mb-4">Your top up has been successful, you can now unlock the lessons</h3>
                <a href="/subjects" class="btn btn-lg btn-primary mr-4">All Subjects</a>
                <a href="/user/student_{{ Auth::user()->id }}" class="btn btn-lg btn-success">Your Dashboard</a>
            </div>
        </div>
    </div>
@endsection
