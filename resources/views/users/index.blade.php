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

  @include('shared.modal_confirm', [
      'title' => 'Delete',
      'body'  => 'Are you sure you want to delete this user?',
      'btn_class' => 'btn-danger btn_delete_confirm'
  ])

  @include('shared.modal_confirm', [
      'modal_id' => 'verify-user-modal',
      'title' => 'Verify',
      'body'  => 'Are you sure you want to verify this user?',
      'btn_class' => 'btn-primary btn_verify_confirm'
  ])

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif


<div class="top-spacing">
  <table class="table table-bordered hidden" id="userTable">
    <thead>
     <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       <th>Department</th>
       <th>Position</th>
       <th>Verified at</th>
       <th width="280px">Action</th>
     </tr>
    </thead>
    <tbody>
      @foreach ($users as $key => $user)
      <tr>
        <td>{{ ++$i }}</td>
        <td><a href="{{ route('user_profile', [$user->id, $user->slug]) }}">{{ $user->firstname. ' '.$user->lastname }}</a></td>
        <td>{{ $user->email }}</td>
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge badge-success">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        <td>{{ $user->department ? $user->department->name : ''  }}</td>
        <td>{{ $user->position ? $user->position->title : '' }}</td>
        <td>
          @if($user->email_verified_at)
            {{ display_date($user->email_verified_at) }}
          @else
            <form action="{{ route('user_verify', $user->id) }}" method="POST" id="user-form-verify-{{ $user->id }}">
              <a class="btn_verify_user" href="#" data-userId="{{ $user->id }}">Verify</a>
              @csrf
            </form>
          @endif
        </td>
        <td>
          <form action="{{ route('users.destroy',$user->id) }}" method="POST" id="user-form-delete-{{ $user->id }}">
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <a class="btn btn-danger btn_delete_confirm" href="#" data-formId="user-form-delete-{{ $user->id }}">Delete</a>
              <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{!! $users->render() !!}


@endsection