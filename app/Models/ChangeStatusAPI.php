<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChangeStatusAPI extends Model
{
    use HasFactory;

    public static function listar($startDate = null, $endDate = null)
    {
        // Define valores padrão para as datas se não forem fornecidas
        $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->subDays(7)->startOfDay();
        $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfDay();

        return DB::connection('sqlite')
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
            ->where('incidentsummary', 'not like', '%GMUD%') // Exclui registros com 'GMUD' no incidentid
            ->whereBetween('min_createdate', [$startDate, $endDate]) // Aplica o filtro de data
            ->groupBy(
                'incidentid',
                'worklogsubmitter',
                'finished_worklogsubmitter' // Inclui no agrupamento para evitar erros de agregação
            )
            ->orderByDesc('time_assigned')
            ->get();
    }
}
