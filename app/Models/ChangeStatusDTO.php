<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ChangeStatusDTO
{
    public static function listar($startDate = null, $endDate = null)
    {
        $query = DB::connection('sqlite')
            ->table('change_status_incident')
            ->select(
                'worklogsubmitter',
                'finished_worklogsubmitter',
                'incidentid',
                'earliest_submit_date',
                'min_createdate',
                'incidentsummary',
                'finished_datetime',
                'status',
                DB::raw('julianday(coalesce(min_createdate, 0)) - julianday(coalesce(earliest_submit_date, 0)) AS time_assigned'),
                DB::raw('julianday(coalesce(finished_datetime, 0)) - julianday(coalesce(min_createdate, 0)) AS time_finished')
            )
            ->whereIn('worklogsubmitter', [
                'samuel.fagundes',
                'marcos.jesus',
                'edgard.araujo',
                'otavio.souza',
                'gabriel.martins',
                'jepherson.lins',
                'pedro.santos'
            ])
            ->where('incidentsummary', 'not like', '%GMUD%'); // Exclui registros com 'GMUD'

        // Aplicar os filtros de data, se fornecidos
        if ($startDate) {
            $query->whereDate('earliest_submit_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('earliest_submit_date', '<=', $endDate);
        }

        return $query
            ->groupBy(
                'incidentid',
                'worklogsubmitter',
                'finished_worklogsubmitter'
            )
            ->orderByDesc('time_assigned')
            ->get();

    }
}
