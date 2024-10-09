<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ChangeStatusDTO
{
    public static function listar($submitters = [], $incidentSummary = null, $startDate = null, $endDate = null)
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
            );

        // Filtro opcional de worklogsubmitters, se o array não estiver vazio
        if (!empty($submitters)) {
            $query->whereIn('worklogsubmitter', $submitters);
        }

        // Filtro opcional para incidentsummary
        if ($incidentSummary) {
            $query->where('incidentsummary', 'not like', "%$incidentSummary%");
        }

        // Filtro opcional para datas
        if ($startDate) {
            $query->whereDate('min_createdate', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('min_createdate', '<=', $endDate);
        }

        // Agrupamento e ordenação
        return $query->groupBy(
                'incidentid',
                'worklogsubmitter',
                'finished_worklogsubmitter'
            )
            ->orderByDesc('time_assigned')
            ->get();
    }
}