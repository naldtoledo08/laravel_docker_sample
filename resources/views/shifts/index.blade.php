@extends('layouts.admin_app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Shifts</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('shifts.create') }}"> Create New Shift</a>
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
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($shifts as $shift)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $shift->name }}</td>
            <td>{{ $shift->description }}</td>
            <td>
                <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('shifts.show', $shift->id) }}">Show</a>                  
                    <a class="btn btn-primary" href="{{ route('shifts.edit', $shift->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


    {!! $shifts->links() !!}


@endsection