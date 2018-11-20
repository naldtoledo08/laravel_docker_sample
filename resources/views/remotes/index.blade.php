@extends('layouts.admin_app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Remote Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('remotes.create') }}"> Create New Remote Detail</a>
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
            <th>IP Address</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($remotes as $remote)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $remote->ip_address }}</td>
            <td>{{ $remote->name }}</td>
            <td>{{ $remote->description }}</td>
            <td>
                <form action="{{ route('remotes.destroy',$remote->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('remotes.edit',$remote->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $remotes->links() !!}

@endsection