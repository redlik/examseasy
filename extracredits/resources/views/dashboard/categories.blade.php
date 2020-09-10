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
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-warning font-weight-bold"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.transactions') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Transactions</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.emails') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Emails</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>
</div>

<div class="col-12 col-md-9 overflow-auto mt-sm-4 mt-md-0 pl-md-4 h-100 pb-4">
    <div class="bg-white rounded shadow h-100 p-4 shadow-sm">
        <h2 class='font-weight-bold text-uppercase'>Categories & Topics</h2>
        <ul class="list-group">
            @foreach ($subjects as $subject)
            <li class="list-group-item font-weight-bold d-flex justify-content-between align-items-center">
                {{ ucfirst($subject->name) }}
                <button class="badge badge-primary badge-pill p-2" data-toggle="modal"
                    data-target="#{{ $subject->name}}Modal">Add Category</button></li>
            @foreach ($subcategories as $subcategory)
                @if ($subcategory->subject_id == $subject->id)
                <li class="list-group-item pl-5 d-flex justify-content-between align-items-center"><span><span class="font-weight-bold">{{ $subcategory->order_position }}</span> - {{ $subcategory->name }}</span>
                    <button class="badge badge-success badge-pill p-2 topic-btn" data-toggle="modal" data-target="#topicsModal"
                        data-category="{{ $subcategory->name }}" data-id="{{ $subcategory->id }}">Add Topic</button></li>
                    @foreach ($topics as $topic)
                        @if ($topic->subcategory_id == $subcategory->id)
                        <li class="list-group-item pl-5 d-flex justify-content-between align-items-center">
                            <span class="text-secondary font-italic pl-3"><span class="font-weight-bold">{{ $topic->order_position }}</span> - {{ $topic->name }}</span>
                                <div class="badge badge-secondary badge-pill p-2 ml-auto" data-toggle="modal" data-target="#topicsModal"
                                data_id="{{ $subcategory->name }}">{{$topic->lesson->count() }} Lessons</div>
                        </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <!-- Modal -->
            <div class="modal fade" id="{{ $subject->name}}Modal" tabindex="-1" role="dialog"
                aria-labelledby="categoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="categoryModalLabel">Create new category under
                                <strong>{{ ucfirst($subject->name) }}</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ action('SubcategoryController@store')}}" method="POST" role="form"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="subjectSelect" value="{{ $subject->id }}" />

                                <div class="form-group">
                                    <label for="name">Name of the category</label>
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="subcategory_order_position">Order position</label>
                                    <input type="text" name="subcategory_order_position" id="subcategory_order_position" class="form-control" placeholder="10"/>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </ul>
    </div>
</div>

<!--- Topics Modal --->
<div class="modal fade" id="topicsModal" tabindex="-1" role="dialog" aria-labelledby="topicsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Create new topic under <strong><span
                            id="categoryModalTitle">123</span></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ action('TopicController@store')}}" method="POST" role="form"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="subcategory_id" id="subcategory_id_input" value="" />

                    <div class="form-group">
                        <label for="title">Name of the topic</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="topic_order_position">Order position</label>
                        <input type="text" name="topic_order_position" id="topic_order_position" class="form-control" placeholder="10"/>
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
@endsection

@section('bottom_scripts')
<script>
    $(document).ready(function () {
        $(function () {
            $(".topic-btn").click(function () {
                var data_var = $(this).data('category');
                var data_id = $(this).data('id');
                console.log(data_id);
                $("#categoryModalTitle").text(data_var);
                $("#subcategory_id_input").val($(this).data('id'));
            })
        });
    });

</script>
@endsection
