@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow" style="height:90%">
    <h4 class="text-white text-center text-uppercase">Categories & Topics</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard') }}" class="text-white"><i
                    class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-warning font-weight-bold"><i
                    class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Students</li>
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Transactions</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Emails</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Coupons</li>
    </ul>
</div>

<div class="col-12 col-md-9 overflow-auto px-md-4 mt-sm-4 mt-md-0">
    <h2 class="font-weight-bold text-uppercase">Create new lesson</h2>
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
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="subjectSelect">Select subject</label>
                    <select name="subjectSelect" id="subjectSelect" class="form-control">
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->id}}">{{ ucfirst($subject->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="subjectCategory">Select Category</label>
                    <select name="subjectCategory" id="subjectCategory" class="form-control"
                        placeholder="Select category">
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="topicSelection">Select Topic</label>
                    <select name="topicSelection" id="topicSelection" class="form-control"
                        placeholder="Select topic">
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
            <div class="col-6">
                <p class="d-block">Select credit cost of the video</p>
                <div class="d-block">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="creditCost" id="creditCost1" value="1"
                            checked>
                        <label class="form-check-label" for="creditCost1">
                            1 Credit
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="creditCost" id="creditCost2" value="2">
                        <label class="form-check-label" for="creditCost2">
                            2 Credits
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>

</div>
@endsection

@section('bottom_scripts')
<script>
    $(document).ready(function () {
        $('#subjectSelect').on('change', function () {
            let id = $(this).val();
            console.log(id);
            $('#subjectCategory').empty();
            $('#subjectCategory').append(`<option value ="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: '/getcategory/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#subjectCategory').empty();
                    $('#subjectCategory').append(
                        `<option value="0" disabled selected>Select Category</option>`);
                    response.forEach(element => {
                        $('#subjectCategory').append(
                            `<option value="${element['id']}">${element['name']}</option>`
                            );
                    });
                }
            });
        });
        $('#subjectCategory').on('change', function () {
            let id = $(this).val();
            console.log(id);
            $('#topicSelection').empty();
            $('#topicSelection').append(`<option value ="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: '/gettopic/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#topicSelection').empty();
                    $('#topicSelection').append(
                        `<option value="0" disabled selected>Select Topic</option>`);
                    response.forEach(element => {
                        $('#topicSelection').append(
                            `<option value="${element['id']}">${element['name']}</option>`
                            );
                    });
                }
            });
        });
    });

</script>
@endsection
