@extends('layouts.admin_app')


@section('content')

@include('users.profile.modal')

 @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ $user->firstname . ' ' . $user->lastname }} Profile</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"> Edit Info</a>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-lg-7">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h4>Personal Information</h4>
			</div>
			<div class="card-body">

				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-2 col-form-label"  for="name">Name :</label>
				         <span>{{ $user->firstname . ' ' . $user->lastname }}</span>
				    </div>
				</div>
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-2 col-form-label text-right"  for="name">Email :</label>
				         <span>{{ $user->email }}</span>
				    </div>
				</div>
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-2 col-form-label text-right"  for="name">Date join :</label>
				         <span>{{ display_date($user->created_at) }}</span>
				    </div>
				</div>
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-2 col-form-label text-right"  for="name">Address :</label>
				         <span> </span>
				    </div>
				</div>

				@foreach($leaves_per_type as $row)
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-2 col-form-label text-right"  for="name">{{ $row->code }} :</label>
				         <span> {{ $row->remaining_leave }} </span>
				    </div>
				</div>
				@endforeach
				
			</div>
		</div>
	</div>
	<div class="col-lg-5">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h4>Schedule</h4>
			</div>
			<div class="card-body">
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-3 col-form-label text-right"  for="name">Type :</label>
				         <span>{{ ucwords($user->employee_schedule->type) }}</span>
				    </div>
				</div>
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-3 col-form-label text-right"  for="name">Shift :</label>
				         <span>{{ $user->employee_schedule->shift->name }}</span>
				    </div>
				</div>
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-3 col-form-label text-right"  for="name">From :</label>
				         <span>{{ display_shift_time($user->employee_schedule->from, $user->employee_schedule->from_flex) }}</span>
				    </div>
				</div>
				<div class="form-inline">
				    <div class="col-md-12 form-group">
				         <label class="col-sm-3 col-form-label text-right"  for="name">To :</label>
				         <span>{{ display_shift_time($user->employee_schedule->to, $user->employee_schedule->to_flex) }}</span>
				    </div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Leave History -->
<div class="row">
	<div class="col-md-12 form-group">
		<div class="card">
			    
			<div class="card-header d-flex align-items-center">
				
				<div class="col-lg-12 margin-tb">
			        <div class="pull-left">
			           <h4>Leave History</h4>
			        </div>
			        <div class="pull-right">
			            <a class="btn-sm btn-primary" href="{{ route('file_leave', $user->id) }}"> File a leave</a>
			        </div>
			    </div>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
			        <tr>
			            <th>No. of day(s)</th>
			            <th>Type</th>
			            <th>From</th>
			            <th>To</th>
			            <th>Approve</th>
			            @role('admin')
			            <th>Action</th>
			            @endrole
			        </tr>
			        @if($user->leave_credits)
			        @foreach ($user->leave_credits as $leave)
			        <tr>
			            <td>{{ $leave->num_of_days }}</td>
			            <td>{{ $leave->leaveType->name }}</td>
			            <td>{{ display_date($leave->from) }}</td>
			            <td>{{ display_date($leave->to) }}</td>
			            <td>{{ (($leave->is_approve == 1) ? 'Yes' : 'No') }}</td>
			            
			            @role('admin')
			            <td>
						    @if($leave->is_approve != 1)
						        <form action="{{ route('approve_leave', $user->id) }}" method="POST" id="leave-form-approve-{{ $leave->id }}">
						          <input type="hidden" value="{{ $leave->id }}" name="id">
						          @csrf
						          <a class="btn btn-info btn_approve_leave" href="#" data-leaveId="{{ $leave->id }}">Approve</a>
						        </form>
						      @else
						         <form action="{{ route('deny_leave', $user->id) }}" method="POST" id="leave-form-deny-{{ $leave->id }}">
						          <input type="hidden" value="{{ $leave->id }}" name="id">
						          @csrf
						          <a class="btn btn-danger btn_deny_leave" href="#" data-leaveId="{{ $leave->id }}">Deny</a>
						        </form>
						      @endif
			            </td>
			            @endrole			           
			        </tr>
			        @endforeach	
			        @endif
			    </table>
			</div>
		</div>
	</div>
</div>

<!-- Timesheet Summary -->
<div class="row">
	<div class="col-md-12 form-group">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<h4>Timesheet Summary</h4>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
			        <tr>
			            <th>Day</th>
			            <th>Date</th>
			            <th>In</th>
			            <th>Out</th>
			        </tr>
			        @foreach ($dates as $date)
			        <tr>
			            <td>{{ display_day($date) }}</td>
			            <td>{{ display_date($date) }}</td>
			            <td>            
			                @if(isset($timesheets[$date]))
			                    {{ display_time($timesheets[$date]->time_in) }}
			                @endif
			            </td>
			            <td>                
			                @if(isset($timesheets[$date]) && isset($timesheets[$date]->time_out))
			                    {{ display_time($timesheets[$date]->time_out) }}
			                @endif
			            </td>
			           
			        </tr>
			        @endforeach
			    </table>
			</div>
		</div>
	</div>
</div>

@endsection