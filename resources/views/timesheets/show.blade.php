@extends('layouts.admin_app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Timesheet - {{ $user->name }}</h2>
            </div>
            <!-- <div class="pull-right">
                @can('department-create')
                <a class="btn btn-success" href="{{ route('departments.create') }}"> Create New Department</a>
                @endcan
            </div> -->
        </div>
    </div>
    @include('timesheets.modal')

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
            <th>Day</th>
            <th>Date</th>
            <th>In</th>
            <th>Out</th>
            @role('admin')
            <th width="280px">Action</th>
            @endrole
        </tr>
        @foreach ($dates as $date)
        <tr>
            <td>{{ display_day($date) }}</td>
            <td>{{ display_date($date) }}</td>
            <td>            
                @if(!isset($timesheets[$date]))
                    @can('remote-access')
                        @if($date == $today)
                            <form action="{{ route('timesheet_login') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $id }}" name="user_id">
                                <button type="submit" class="btn btn-danger">Login</button>
                            </form>
                        @endif
                    @endcan
                @else
                    {{ display_time($timesheets[$date]->time_in) }}
                @endif
            </td>
            <td>                
                @if(isset($timesheets[$date]))
                    @if(!isset($timesheets[$date]->time_out))
                        @can('remote-access')
                            @if(isset($timesheets[$date]->time_in) && $date == $today)
                                <form action="{{ route('timesheet_logout') }}" method="POST" id="timesheet-logout-{{ $timesheets[$date]->id }}">
                                    @csrf
                                    <input type="hidden" value="{{ $id }}" name="user_id">
                                    <input type="hidden" value="{{ $timesheets[$date]->id }}" name="id">
                                    <a class="btn btn-danger" href="#" id="btn_logout" data-timesheetId="{{ $timesheets[$date]->id }}">Logout</a>
                                    <!-- <button  class="btn btn-danger" id="btn_logout" data-timesheetId="{{ $timesheets[$date]->id }}">Logout</button> -->
                                </form>
                            @endif
                        @endcan
                    @else
                        {{ display_time($timesheets[$date]->time_out) }}
                    @endif
                @endif
            </td>
            @role('admin')
            <td>
                @if(isset($timesheets[$date]))
                <form action="{{ route('timesheets.destroy',$timesheets[$date]->id) }}" method="POST" id="timesheet-form-delete-{{ $timesheets[$date]->id }}">
                    <input type="hidden" value="{{ $id }}" name="user_id">
                    <input type="hidden" value="{{ $timesheets[$date]->id }}" name="id">
                    <a class="btn btn-primary" href="{{ route('timesheets.edit',$timesheets[$date]->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger btn_delete_timein" href="#" data-timesheetId="{{ $timesheets[$date]->id }}">Delete</a>
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                </form>
                @endif
            </td>
            @endrole
        </tr>
        @endforeach
    </table>


@endsection
