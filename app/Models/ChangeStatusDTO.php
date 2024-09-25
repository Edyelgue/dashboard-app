<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChangeStatusDTO
{
    public static function listar()
    {
        return DB::connection('sqlite')
            ->table('change_status_incident')
            ->select(
                'createdate',
                'modifieddate',
                'worklogsubmitter',
                'incidentid',
                DB::raw('((JULIANDAY(modifieddate) - JULIANDAY(createdate)) * 24) AS DiferencaEmHoras')
            )
            ->where('createdate', '>=', now()->subDays(1)->format('Y-m-d H:i:s'))
            ->where('notes', 'like', '%Assigned To: %')
            ->where('notes', 'NOT LIKE', '%Assigned To: helix.user%')
            ->where('incidentsummary', 'NOT LIKE', '%GMUD%')
            ->whereIn('worklogsubmitter', [
                'edgard.araujo',
                'marcos.jesus',
                'samuel.fagundes',
                'samuel.souza',
                'evandro.pereira',
                'camilly.psilva',
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
            ->orderBy('modifieddate', 'DESC')
            ->get();
    }
}
