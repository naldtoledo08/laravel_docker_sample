@extends('layouts.admin_app')


 @section('content')
  <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Monitoring</h2>
        </div>
    </div>
  </div>

  <div class="row" id="monitoring-container">
    @foreach($users as $row)
      <div class="col-md-2 text-center pt-3" id="monitoring-user-{{ $row->user->id }}">
        <div class="login-photo">
          <a href="{{ route('user_profile', [$row->user->id, $row->user->slug]) }}">
            <img src="{{ asset('theme/img/avatar-default.jpg') }}" alt="person" class="img-fluid rounded-circle">
          </a>
        </div>
        <div class="content">
          <a href="{{ route('user_profile', [$row->user->id, $row->user->slug]) }}">
            <strong> {{ $row->user->firstname . ' ' . $row->user->lastname }}</strong>
          </a>
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
      .bind('login', function (data) {
        console.log('login');
        console.log(data);

        var html = '<div class="col-md-2 text-center pt-3" id="monitoring-user-' + data.timesheet.user_id + '">';
        html += '<div class="login-photo">';
        html += '<a href="/users/' + data.timesheet.user_id + '/' + data.timesheet.user_slug + '/profile">';
        html += '<img src="/theme/img/avatar-default.jpg" alt="person" class="img-fluid rounded-circle">';
        html += '</a>';
        html += '</div>';
        html += '<div class="content">';
        html += '<a href="/users/' + data.timesheet.user_id + '/' + data.timesheet.user_slug + '/profile">';
        html += '<strong> ' + data.timesheet.user_name +'</strong>';
        html += '</a>';
        html += '<div class="full-date"><small>Login ' + data.timesheet.time_in_display +'</small></div>';
        html += '</div>';
        html += '</div>';
        $('#monitoring-container').prepend(html);
      });

  socket.subscribe('timesheet-monitoring')
      .bind('logout', function (data) {
        console.log('logout');
        console.log(data);

        $("#monitoring-user-" + data.timesheet.user_id).fadeOut("normal", function() {
          console.log('remove');
            $(this).remove();
        });
          //$('#monitoring-container').prepend($newRow);
      });
</script>