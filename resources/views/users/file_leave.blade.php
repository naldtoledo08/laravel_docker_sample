@extends('layouts.admin_app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>File a leave</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user_profile', [$user->id, $user->slug]) }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::open(array('route' => ['file_leave_create', $user->id],'method'=>'POST')) !!}
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type:</strong>
            {!! Form::select('leave_type_id', $leave_types, [], array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>From:</strong>
            <input type="hidden" name="user_id" readonly="true" value="{{ $user->id }}" class="form-control">
            {!! Form::text('from', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>To:</strong>
            {!! Form::text('to', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Number of days:</strong>
            {!! Form::text('num_of_days', null, array('placeholder' => '','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Reason:</strong>
            {!! Form::textarea('description', null, array('placeholder' => 'Please type your reason here!','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection