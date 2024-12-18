<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class FinishedStatusNMDTO
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
                'jean.novaes',
                'henrique.oliveira',
                'vitor.domingues',
                'jeferson.dorta',
                'camilly.psilva',
                'miguel.amaral',
                'luan.pereira',
                'murilo.medeiros',
                'mateus.tofani',
                'joao.souza',
                'lucas.angelo',
                'leopoldo.junior',
                'evandro.pereira',
                'vinicyus.santos',
                'vinicius.mareti',
                'jefferson.correia'
            ])
            ->groupBy('finished_worklogsubmitter', 'status')
            ->get()
            ->groupBy('finished_worklogsubmitter')
            ->toArray();
    }
}
