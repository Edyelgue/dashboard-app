<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChangeStatusDTO
{
    public static function listar()
    {
        return DB::connection('sqlite')
            ->table('change_status_incident')
            ->select(
                'worklogsubmitter',
                'incidentid',
                'earliest_submit_date',
                'min_createdate',
                DB::raw('julianday(coalesce(min_createdate, 0)) - julianday(coalesce(earliest_submit_date, 0)) AS time_assigned') // Fixed aliasing and julianday calculation
            )
            ->whereIn('worklogsubmitter', [
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
            ->whereDate('min_createdate', '>=', Carbon::now()->subDays(7)) // Filter records from the last 7 days
            ->groupBy(
                'incidentid',
                'worklogsubmitter'
            )
            ->orderByDesc('earliest_submit_date')
            // ->limit(50)
            ->get();
    }
}
