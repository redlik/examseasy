@extends('layouts.app')

@section('content')
<div class="col">
    <form action="{{ action('PagesController@topup') }}" method="POST" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Amount of topup</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="topup" id="gridRadios1" value="60" checked>
                  <label class="form-check-label" for="gridRadios1">
                    60 Credits
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="topup" id="gridRadios2" value="90">
                  <label class="form-check-label" for="gridRadios2">
                    90 Credits
                  </label>
                </div>
                <div class="form-check disabled">
                  <input class="form-check-input" type="radio" name="topup" id="gridRadios3" value="120">
                  <label class="form-check-label" for="gridRadios3">
                    120 Credits
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
          <input type="submit" value="Submit" class="btn btn-primary">
    </form>
</div>
@endsection