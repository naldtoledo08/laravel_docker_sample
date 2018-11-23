@extends('layouts.admin_app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ $user->name }} Schedule</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user_profile', $user->id) }}"> Back</a>
        </div>
    </div>
</div>


<form action="{{ route('schedule_update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" readonly="true" value="{{ $user->name }}" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Remarks:</strong>
                <textarea class="form-control" style="height:150px" name="remarks" placeholder="Remarks"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>


@endsection