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
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Students</li>
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Transactions</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Emails</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-warning font-weight-bold"><i
                    class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>
</div>

<div class="col-12 col-md-9 overflow-auto mt-sm-4 mt-md-0 pl-md-4 h-100 pb-4">
    <div class="bg-white rounded shadow h-100 p-4 shadow-sm">
        <h2 class='font-weight-bold text-uppercase'>Coupons</h2>
        <table class="table">
            <thead class="thead-dark rounded">
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Type</th>
                    <th scope="col">Value</th>
                    <th scope="col">Expiry</th>
                    <th scope="col">Used</th>
                    <th scope="col">Limit</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                <tr @if ($coupon->enabled == 0)
                    class="text-muted bg-light"
                @endif
                >
                    <th scope="row">
                        {{ $coupon->code }}<br>
                    </th>
                    <td>
                        @if ($coupon->type == "fixed")
                            F
                        @else
                            P
                        @endif
                    </td>
                    <td>
                        @if ($coupon->type == "fixed")
                          €{{ $coupon->value}}  
                        @else
                        {{ $coupon->value}}%
                        @endif
                    </td>
                    <td>{{ $coupon->expiry ?? 'None'}}</td>
                    <td>20</td>
                    <td>{{ $coupon->limit_of_uses ?? 'None'}}</td>
                    <td>@if ($coupon->enabled)
                        <a href="{{ route('dashboard.coupons.enable', [$coupon->id]) }}" class="btn btn-warning mr-2">Disable</a>
                    @else
                        <a href="{{ route('dashboard.coupons.enable', [$coupon->id]) }}" class="btn btn-primary mr-2">Enable</a>
                    @endif
                        <a href="{{ route('dashboard.coupons.delete', [$coupon->id]) }}" class="btn btn-danger mr-2" onclick="return confirm('Do you want to delete the coupon completely?')">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-success text-right" data-toggle="modal" data-target="#couponModal"><i
                class="fas fa-plus mr-2"></i> Add New Coupon</button>
    </div>

    <div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="couponModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Create new coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ action('CouponController@store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="enabled" value="1" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="code">Coupon code (min. 4 characters)</label>
                                <input type="text" name="code" id="code" class="form-control" minlength="4"/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="type">Coupon type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="0" disabled selected>Select type</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percentage</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="value">Discount amount
                                    <span id="fixedBox" style="display: none;">in €:</span>
                                    <span id="percentBox" style="display: none;">in %:</span>
                                </label>
                                <input type="text" name="value" id="value" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="limited">Limited use</label>
                                <select name="limited" id="limited" class="form-control">
                                    <option value="x" disabled selected>Select option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="limit_of_uses">Number of uses</label>
                                <input type="number" name="limit_of_uses" id="limit_of_uses" class="form-control"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date <em>(optional)</em></label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                          </div>
                                        <input type="text" name="expiry" class="form-control" id="expiry_date">
                                    </div>
                                </div>
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

@section('bottom_scripts')
<script type="text/javascript">
    $(function () {
        $("#type").change(function () {
            if ($(this).val() == "fixed") {
                $("#value").attr("readonly", false);
                $("#fixedBox").show();
                $("#percentBox").hide();
            } else {
                $("#value").attr("readonly", false);
                $("#percentBox").show();
                $("#fixedBox").hide();
            }
        });
        $("#limited").change(function () {
            if ($(this).val() == "1") {
                $("#limit_of_uses").attr("readonly", false);
            } else {
                $("#limit_of_uses").val('');
                $("#limit_of_uses").attr("readonly", true);
            }
        });
        $('.input-group.date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        });
    });

</script>

@endsection
