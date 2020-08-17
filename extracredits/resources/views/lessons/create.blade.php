@extends('layouts.app')

@section('content')
<div class="col">
    <h2>Create new lesson</h2>
    <form action="{{ action('LessonsController@store')}}" method="POST" role="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="title">Title of the lesson</label>
            <input type="text" name="title" id="title" class="form-control" />
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="link">Link to video</label>
                    <input type="text" name="link" id="link" class="form-control"
                        placeholder="https://vimeo.com/234200580" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="thumbnail">Lesson thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Lesson Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
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
            <div class="col-6">
                <div class="form-group">
                    <label for="subjectCategory">Select Category</label>
                    <select name="subjectCategory" id="subjectCategory" class="form-control" placeholder="Select category">
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