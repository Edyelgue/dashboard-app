<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncidentController extends Controller
{
    /**
     * Listar incidentes dos últimos 7 dias com base na coluna earliest_submit_date.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listarUltimos7Dias()
    {
        // Define a data de hoje e a data de 7 dias atrás
        $dataHoje = now();
        $data7DiasAtras = now()->subDays(7);

        // Executa a consulta filtrando pelos últimos 7 dias
        $resultados = DB::connection('sqlite')
            ->table('change_status_incident')
            ->select(
                'worklogsubmitter',
                'incidentid',
                DB::raw('MIN(earliest_submit_date) AS earliest_submit_date'),
                DB::raw('MIN(min_createdate) AS min_createdate'),
                DB::raw('(julianday(MIN(DATETIME(min_createdate))) - julianday(MIN(DATETIME(earliest_submit_date)))) AS time_assigned'),
                'notes',
                'incidentsummary',
                'dsk_gst_massiverelated'
            )
            ->where('dsk_gst_massiverelated', 'Não')
            ->where('notes', 'LIKE', '%Assigned To: %')
            ->where('incidentsummary', 'LIKE', '%Massive number of unavailable resources%')
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
            // Filtro para as últimas 7 datas usando earliest_submit_date
            ->whereBetween('earliest_submit_date', [$data7DiasAtras, $dataHoje])
            ->groupBy(
                'incidentid',
                'worklogsubmitter',
                'notes',
                'incidentsummary',
                'dsk_gst_massiverelated'
            )
            ->orderByDesc('earliest_submit_date') // Ordenar pelos últimos mais recentes
            ->get();

        // Retorna os resultados em formato JSON
        return response()->json($resultados);
    }
}
