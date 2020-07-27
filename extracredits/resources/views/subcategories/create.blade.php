@extends('layouts.app')

@section('content')
<div class="col">
    <h2>Create new lesson</h2>
    <form action="{{ action('SubcategoryController@store')}}" method="POST" role="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="title">Name of the subcategory</label>
            <input type="text" name="title" id="title" class="form-control" />
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="subjectSelect">Select subject</label>
                    <select name="subjectSelect" id="subjectSelect" class="form-control">
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->id}}">{{ ucfirst($subject->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>

</div>
@endsection