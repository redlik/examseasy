@extends('layouts.app')

@section('content')
<div class="col">
    <h2>Edit "{{ $lesson->title }}" lesson</h2>
    <form action="{{ action('LessonsController@update', [$lesson->id])}}" method="POST" role="form" enctype="multipart/form-data">
        @method('PATCH')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{ $lesson->id }}" />
        <div class="form-group">
            <label for="title">Title of the lesson</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $lesson->title }}"/>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="link">Link to video</label>
                    <input type="text" name="link" id="link" class="form-control"
                        value="{{ $lesson->link }}" />
                </div>
            </div>
            <div class="col-6">
                <div class="d-inline-block mr-3">
                    Existing file:<br/>
                    <img src="/images/thumbnails/{{ $lesson->thumbnail }}" width='120px' height='90px' style='object-fit: cover;' />
                </div>
                <div class="form-group d-inline-block">
                    <label for="thumbnail">Lesson thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Lesson Description</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ $lesson->description }}</textarea>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="subjectSelect">Select subject</label>
                    <select name="subjectSelect" id="subjectSelect" class="form-control">
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->id}}" {{ $subject->id == $lesson->subject_id ? 'selected' : ''}} >{{ ucfirst($subject->name) }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="subjectCategory">Select Category</label>
                    <select name="subjectCategory" id="subjectCategory" class="form-control" placeholder="Select category">
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id}}" {{ $subcategory->id == $lesson->category_id ? 'selected' : ''}} >{{ ucfirst($subcategory->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="levelSelect">Select level</label>
                    <select name="levelSelect" id="levelSelect" class="form-control">
                        @foreach ($levels as $level)
                        <option value="{{ $level->id}}">{{ ucfirst($level->level_name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>

</div>
@endsection

@section('bottom_scripts')
    <script>
        $(document).ready(function() {
            $('#subjectSelect').on('change', function () {
                let id = $(this).val();
                console.log(id);
                $('#subjectCategory').empty();
                $('#subjectCategory').append(`<option value ="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getcategory/' + id,
                    success: function(response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#subjectCategory').empty();
                        $('#subjectCategory').append(`<option value="0" disabled selected>Select Category</option>`);
                        response.forEach(element => {
                            $('#subjectCategory').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    
    
    </script>
@endsection