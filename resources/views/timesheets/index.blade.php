@extends('layouts.admin_app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Position</th>
        <th>Last time-in</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td></td>
        <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
        <td>{{ $user->department ? $user->department : ''  }}</td>
        <td>{{ $user->position ? $user->position : '' }}</td>
        <td>{{ $user->last_time_in ? display_date_time($user->last_time_in) : '' }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('timesheets.show',$user->id) }}">Show</a>
            <!-- <a class="btn btn-primary" href="{{ route('timesheets.edit',$user->id) }}">Edit</a> -->
        </td>
    </tr>
     @endforeach
</table>




@endsection