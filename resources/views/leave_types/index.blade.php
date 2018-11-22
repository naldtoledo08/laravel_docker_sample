@extends('layouts.admin_app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Leave Type</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('leave-types.create') }}"> Create New Leave Type</a>
            </div>
        </div>
    </div>

    @include('shared.modal_confirm', [
        'title' => 'Delete',
        'body'  => 'Are you sure you want to delete this Type of Leave?',
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
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($leave_types as $leave_type)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $leave_type->name }}</td>
            <td>{{ $leave_type->description }}</td>
            <td>
                <form action="{{ route('leave-types.destroy', $leave_type->id) }}" method="POST" id="leave-type-form-delete-{{ $leave_type->id }}">
                    <a class="btn btn-info" href="{{ route('leave-types.show', $leave_type->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('leave-types.edit', $leave_type->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger btn_delete_confirm" href="#" data-formId="leave-type-form-delete-{{ $leave_type->id }}">Delete</a>
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                </form>
            </td>
        </tr>
        @endforeach
    </table>


    {!! $leave_types->links() !!}


@endsection