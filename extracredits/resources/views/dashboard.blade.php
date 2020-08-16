@extends('layouts.app')

@section('content')
<div class="col">
    <h3>Hi, {{ $user->name }}</h3>
    <ul class="nav nav-tabs" id="dashboard" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="lessonsTab" data-toggle="tab" href="#lessons" role="tab"
                aria-controls="lessons" aria-selected="true">Lessons</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="usersTab" data-toggle="tab" href="#users" role="tab" aria-controls="users"
                aria-selected="false">Users</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="subjectsTab" data-toggle="tab" href="#subjects" role="tab" aria-controls="subjects"
                aria-selected="false">Subjects</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="lessons" role="tabpanel" aria-labelledby="lessons-tab">
            <h2 class="my-4">List of Lessons</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-4">Title</th>
                        <th scope="col" class="col-2">Subject</th>
                        <th scope="col" class="col-2">Unlocked</th>
                        <th scope="col" class="col-3">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                    <tr class="{{$lesson->subject->name}}">
                        <th scope="row">{{ $lesson->id }}</th>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ ucfirst($lesson->subject->name) }}</td>
                        <td>{{ $lesson->user_count }}</td>
                        <td><a href="{{ url('/lesson', [$lesson->id]) }}" class="btn btn-success mx-lg-1">View</a>
                            <a href="" class="btn btn-primary">Edit</a>
                            @if ($lesson->user_count < 1) <a href="" class="btn btn-danger mx-lg-1">Delete</a>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/lesson/create') }}" class="btn btn-danger text-right">Add New</a>
        </div>
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            <h2 class="my-4">List of Users</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-3">Name</th>
                        <th scope="col" class="col-3">Email</th>
                        <th scope="col" class="col-2">Credits</th>
                        <th scope="col" class="col-3">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->credits }}</td>
                        <td><a href="{{ route('user_panel', [$user->id]) }}" class="btn btn-primary">View details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="tab-pane fade" id="subjects" role="tabpanel" aria-labelledby="subjects-tab">
            <h2 class="my-4">List of Subjects & Subcategories</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#exampleModal">
                Add new subcategory
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create new Subcategory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ action('SubcategoryController@store')}}" method="POST" role="form"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

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

                                <div class="form-group">
                                    <label for="title">Name of the subcategory</label>
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @foreach ($subjects as $subject)
            <div class="row">
                <div class="col-8">
                    <div class="mb-4">
                        <div class="p-3 mb-2 bg-dark text-white rounded-sm">
                            <h4>
                                {{ ucfirst($subject->name) }} - @if ($subject->lesson->count() < 1) No lessons yet @else
                                    {{$subject->lesson->count() }} lessons @endif </h4> </div> <ul
                                    class="list-group list-group-flush">
                                    @foreach ($subject->subcategory as $subcategory)
                                    <li class="list-group-item">{{ ucfirst($subcategory->name) }}</li>
                                    @endforeach
                                    </ul>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection
