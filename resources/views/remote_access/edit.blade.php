@extends('layouts.admin_app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Remote Access</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('remote-access.index') }}"> Back</a>
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


{!! Form::model($remote_access, ['method' => 'PATCH','route' => ['remote-access.update', $remote_access->id]]) !!}
<div class="row">


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>User:</strong>
            <input type="hidden" name="user_id" value="{{ $remote_access->user_id}}" >
            {!! Form::select('user_id', $users, $remote_access->user_id, array('class' => 'form-control', 'disabled'=> true)) !!}
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>From:</strong>
            {!! Form::text('from', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control datepicker', 'readonly' => true)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>To:</strong>
            {!! Form::text('to', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control datepicker', 'readonly' => true)) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Reason:</strong>
            {!! Form::textarea('reason', null, array('placeholder' => 'Please type your reason here!','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection