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

@if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
@endif

{!! Form::model($employee_schedule, ['method' => 'PATCH','route' => ['schedule_update', $user->id]]) !!}
<form action="{{ route('schedule_update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="hidden" name="id" readonly="true" value="{{ $employee_schedule->id }}" class="form-control">
                <input type="hidden" name="user_id" readonly="true" value="{{ $employee_schedule->user_id }}" class="form-control">
                <input type="text" name="name" readonly="true" value="{{ $user->name }}" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>From:</strong>
                {!! Form::text('from', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>From flex:</strong>
                {!! Form::text('from_flex', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control')) !!}
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
                <strong>To flex:</strong>
                {!! Form::text('to_flex', null, array('placeholder' => 'yyyy-mm-dd','class' => 'form-control')) !!}
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
</form>


@endsection