@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="col-12 mb-4">
        <h1 class="text-center main-heading display-3 mb-3">Contact us</h1>
        <h5 class="text-center text-secondary">We love to hear your feedback, about the service, the content or anything
            in between. <br />Drop us a message in the form below and we promise to get back to you as soon as we can.
        </h5>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 bg-white rounded shadow p-3">
            <h4 class="text-center font-weight-bold mb-3">Contact form</h4>
            @if(session('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" method="POST" action="/contact">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="Name">Name: </label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea type="text" class="form-control" id="message" placeholder="Enter your message here"
                        name="message" required> </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="Send">Send message</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
