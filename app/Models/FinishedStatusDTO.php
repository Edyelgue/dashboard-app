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
                'edgard.araujo',
                'marcos.jesus',
                'samuel.fagundes',
                'samuel.souza',
                'evandro.pereira',
                'camilly.psilva',
                'jeferson.dorta',
                'gabriel.martins',
                'mateus.tofani',
                'murilo.medeiros',
                'otavio.souza',
                'lucas.angelo',
                'eduardo.rezende',
                'jepherson.lins',
                'pedro.santos',
                'rafael.olima',
                'vinicius.mareti'
            ])
            ->groupBy('finished_worklogsubmitter', 'status')
            ->get()
            ->groupBy('finished_worklogsubmitter')
            ->toArray();
    }
}
