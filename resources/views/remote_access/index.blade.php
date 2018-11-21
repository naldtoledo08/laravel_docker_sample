@extends('layouts.admin_app')


@section('content')

@include('remote_access.modal')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Remote Access Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('remote-access.create') }}"> Create New User Remote Access</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>User</th>
   <th>From</th>
   <th>To</th>
   <th>Reason</th>
   <th>Approve</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($remote_access as $key => $row)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $row->user->name }}</td>
    <td>{{ display_date($row->from) }}</td>
    <td>{{ display_date($row->to) }}</td>
    <td>{{ $row->reason }}</td>
    <td>{{ $row->approve }}</td>
    <td>

      <form action="{{ route('approve_remote_access') }}" method="POST" id="remote-access-form-approve-{{ $row->id }}">
        <input type="hidden" value="{{ $row->id }}" name="id">
        <a class="btn btn-primary" href="{{ route('remote-access.edit', $row->id) }}">Edit</a>
        @csrf
        <a class="btn btn-primary btn_approve_access" href="#" data-remoteAccessId="{{ $row->id }}">Approve</a>
        <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
      </form>
    </td>
  </tr>
 @endforeach
</table>


{!! $remote_access->render() !!}


@endsection