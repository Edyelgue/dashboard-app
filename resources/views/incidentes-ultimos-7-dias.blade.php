<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidentes - Últimos 7 Dias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Incidentes dos Últimos 7 Dias</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Submitter</th>
                    <th>Incident ID</th>
                    <th>Earliest Submit Date</th>
                    <th>Create Date</th>
                    <th>Time Assigned (days)</th>
                    <th>Notes</th>
                    <th>Incident Summary</th>
                </tr>
            </thead>
            <tbody>
                @forelse($incidents as $incident)
                    <tr>
                        <td>{{ $incident->worklogsubmitter }}</td>
                        <td>{{ $incident->incidentid }}</td>
                        <td>{{ \Carbon\Carbon::parse($incident->earliest_submit_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($incident->createdate)->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($incident->time_assigned, 2) }}</td>
                        <td>{{ $incident->notes }}</td>
                        <td>{{ $incident->incidentsummary }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhum incidente encontrado nos últimos 7 dias.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
