@extends('layouts.admin_app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{ $user->name }} Profile</h2>
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
				         <span>{{ $user->name }}</span>
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