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
                DB::raw('(JULIANDAY(modifieddate) - JULIANDAY(createdate)) AS DiferencaEmHoras')
            )
            ->where('createdate', '>=', now()->subDays(7)->format('Y-m-d H:i:s'))
            ->where('notes', 'like', '%Assigned To: %')
            ->where('notes', 'NOT LIKE', '%Assigned To: helix.user%')
            ->orderBy('modifieddate', 'DESC')
            ->get();
    }
}
