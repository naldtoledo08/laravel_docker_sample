@extends('layouts.admin_app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            </div>
        </div>
    </div>

    @include('shared.modal_confirm', [
          'title' => 'Delete',
          'body'  => 'Are you sure you want to delete this role?',
          'btn_class' => 'btn-danger btn_delete_confirm'
        ])

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
      <tr>
         <th>No</th>
         <th>Name</th>
         <th width="280px">Action</th>
      </tr>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <form action="{{ route('roles.destroy',$role->id) }}" method="POST" id="role-form-delete-{{ $role->id }}">
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>                
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger btn_delete_confirm" href="#" data-formId="role-form-delete-{{ $role->id }}">Delete</a>
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                </form>
            </td>
        </tr>
        @endforeach
    </table>


{!! $roles->render() !!}


@endsection