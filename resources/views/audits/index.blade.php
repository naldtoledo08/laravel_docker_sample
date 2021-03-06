@extends('layouts.admin_app')


 @section('content')
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Model</th>
          <th scope="col">Action</th>
          <th scope="col">User</th>
          <th scope="col">Time</th>
          <th scope="col">Old Values</th>
          <th scope="col">New Values</th>
        </tr>
      </thead>
      <tbody id="audits">
        @foreach($audits as $audit)
          <tr>
            <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
            <td>{{ $audit->event }}</td>
            <td>{{ $audit->user->full_name }}</td>
            <td>{{ $audit->created_at }}</td>
            <td>
              <table class="table">
                @foreach($audit->old_values as $attribute => $value)
                  <tr>
                    <td><b>{{ $attribute }}</b></td>
                    <td>{{ $value }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="table">
                @foreach($audit->new_values as $attribute => $value)
                  <tr>
                    <td><b>{{ $attribute }}</b></td>
                    <td>{{ $value }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
@endsection


<script src="https://js.pusher.com/4.2/pusher.min.js"></script>
<script>
  var socket = new Pusher("7cb1f0cffe980da86c05", {
      cluster: 'ap1',
  });
  socket.subscribe('audits')
      .bind('new-audit', function (data) {
          var audit = data.audit;
          var $modelCell = $('<td>').text(audit.auditable_type + '(id: ' + audit.auditable_id + ')');
          var $eventCell = $('<td>').text(audit.event);
          var $userCell = $('<td>').text(audit.user_name);
          var $timeCell = $('<td>').text(audit.created_at);

          function createSubTable(values) {
            var $table = $('<table>').addClass('table');
              for (attribute in values) {
                $table.append(
                  $('<tr>').append(
                    $('<td>').text(attribute),
                    $('<td>').text(values[attribute])
                  )
                );
              }
              return $table;
          }

          var $oldValuesTable = createSubTable(audit.old_values)
          var $newValuesTable = createSubTable(audit.new_values)

          var $oldValuesCell = $('<td>').append($oldValuesTable);
          var $newValuesCell = $('<td>').append($newValuesTable);

          $newRow = $('<tr>').append(
            $modelCell,
            $eventCell,
            $userCell,
            $timeCell,
            $oldValuesCell,
            $newValuesCell
          );
          $('#audits').prepend($newRow);
      });
</script>