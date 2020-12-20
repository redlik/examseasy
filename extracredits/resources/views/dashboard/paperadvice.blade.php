@extends('layouts.app')

@section('extra_scripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@endsection

@section('extra_styles')
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow" style="height:90%">
    <h4 class="text-white text-center text-uppercase">Categories & Topics</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard') }}" class="text-white"><i
                    class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.paperadvice') }}" class="text-warning font-weight-bold"><i
            class="fas fa-chevron-right pr-1"></i> Paper Advice Videos</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.transactions') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Transactions</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.emails') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Emails</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>
</div>

<div class="col-12 col-md-9 overflow-auto mt-sm-4 mt-md-0 pl-md-4 h-100 pb-4">
    <div class="bg-white rounded shadow h-100 p-4 shadow-sm">
        <h2 class='font-weight-bold text-uppercase'>Exam Advice Videos</h2>
        <table class="table">
            <thead class="thead-dark rounded">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Link</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->link }}</td>
                    <td>
                        <a href="{{ route('dashboard.paperadvice.delete', [$video->id]) }}" class="btn btn-danger mr-2" onclick="return confirm('Do you want to delete the video completely?')">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-success text-right" data-toggle="modal" data-target="#videoModal"><i
                class="fas fa-plus mr-2"></i> Add New Video</button>
    </div>

    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Create new Advice video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ action('PaperadviceController@store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="title">Video Title</label>
                                <input type="text" name="title" id="title" class="form-control"/ required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="link">Vimeo Link</label>
                                <input type="url" name="link" id="link" class="form-control"/ required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" value="Create" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

