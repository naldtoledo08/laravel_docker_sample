@extends('layouts.admin_app')


 @section('content')
  <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Monitoring</h2>
        </div>
    </div>
  </div>

  <div class="row">
    @foreach($users as $row)
      <div class="col-md-3 text-center">
        <div class="login-photo">
          <a href="#">
            <img src="{{ asset('theme/img/avatar-5.jpg') }}" alt="person" class="img-fluid rounded-circle" style="max-height: 100px;">
          </a>
        </div>
        <div class="content">
          <strong> {{ $row->user->firstname . ' ' . $row->user->lastname }}</strong>
          <div class="full-date"><small>Login {{ display_time($row->time_in) }}</small></div>
        </div>
      </div>
    @endforeach
  </div>
@endsection


<script src="https://js.pusher.com/4.2/pusher.min.js"></script>
<script>
  var socket = new Pusher("7cb1f0cffe980da86c05", {
      cluster: 'ap1',
  });
  socket.subscribe('timesheet-monitoring')
      .bind('new-login', function (data) {
        console.log(data);
          //$('#monitoring-container').prepend($newRow);
      });
</script>