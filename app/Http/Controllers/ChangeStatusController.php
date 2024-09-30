<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusDTO;
use Carbon\Carbon;

class ChangeStatusController extends Controller
{
    public function index()
    {
        // Chamando o método listar()
        $changes = ChangeStatusDTO::listar();
        
        // Formatando as datas e calculando o time_assigned em hh:mm:ss
        foreach ($changes as $change) {
            // Formatando as datas
            $change->earliest_submit_date = 
                Carbon::parse($change->earliest_submit_date)
                ->format('d/m/Y H:i:s');
            $change->createdate = 
                Carbon::parse($change->createdate)
                ->format('d/m/Y H:i:s');
            
            // Convertendo time_assigned (em dias) para horas, minutos e segundos
            $totalSeconds = $change->time_assigned * 24 * 60 * 60; // converter dias para segundos

            // Calculando horas, minutos e segundos
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            // Formatando o time_assigned em hh:mm:ss
            $change->time_assigned = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        
        // Passando os dados formatados para a view
        return view('time-assigned', ['changes' => $changes]);
    }
}
