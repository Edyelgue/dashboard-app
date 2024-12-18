<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class FinishedStatusDTO
{
    /**
     * Retorna os dados agregados por status e analista.
     */
    public static function getTicketsGroupedByStatus()
    {
        return DB::connection('sqlite')
            ->table('change_status_incident')
            ->select(
                'finished_worklogsubmitter',
                'status',
                DB::raw('count(*) as total')
            )
            ->whereIn('finished_worklogsubmitter', [
                'samuel.fagundes',
                'marcos.jesus',
                'edgard.araujo',
                'otavio.souza',
                'gabriel.martins',
                'jepherson.lins',
                'pedro.santos'
            ])
            ->groupBy('finished_worklogsubmitter', 'status')
            ->get()
            ->groupBy('finished_worklogsubmitter')
            ->toArray();
    }
}
