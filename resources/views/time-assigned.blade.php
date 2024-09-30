@foreach ($changes as $change)
  <pre>
    {{ $change->incidentid }}
    {{ $change->worklogsubmitter }}
    {{ $change->earliest_submit_date }}
    {{ $change->createdate }}
    {{ $change->time_assigned }}
  </pre>
@endforeach