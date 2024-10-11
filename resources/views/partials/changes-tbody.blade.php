@foreach ($changes as $change)
<tr>
    <td class="px-4 py-1 text-gray-500">{{ $change->incidentid }}</td>
    <td class="px-4 py-1 text-gray-500">{{ $change->worklogsubmitter }}</td>
    <td class="px-4 py-1 text-gray-500">{{ $change->incidentsummary }}</td>
    <td class="px-4 py-1 text-gray-500">{{ $change->earliest_submit_date }}</td>
    <td class="px-4 py-1 text-gray-500">{{ $change->min_createdate }}</td>
    <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->time_assigned }}</td>
    <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->finished_datetime }}</td>
    <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->time_finished }}</td>
    <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->status }}</td>
</tr>
@endforeach
