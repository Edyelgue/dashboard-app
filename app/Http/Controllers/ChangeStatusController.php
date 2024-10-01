<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusDTO;
use Carbon\Carbon;

class ChangeStatusController extends Controller
{
    public function renderizarView($view, $data = [])
    {
        return view($view, $data);
    }

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
            $change->min_createdate =
                Carbon::parse($change->min_createdate)
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
        return $this->renderizarView('time-assigned', ['changes' => $changes]);
    }

    public function media()
    {
        // Chamando o método listar()
        $changes = ChangeStatusDTO::listar();

        // Inicializando array para agrupar os tempos por analista
        $analistas = [];

        foreach ($changes as $change) {
            $analista = $change->worklogsubmitter;

            // Se o analista ainda não estiver no array, inicializamos com um array vazio
            if (!isset($analistas[$analista])) {
                $analistas[$analista] = [
                    'total_seconds' => 0,
                    'count' => 0
                ];
            }

            // Convertendo time_assigned (em dias) para segundos
            $totalSeconds = $change->time_assigned * 24 * 60 * 60;

            // Adicionando o tempo para o analista correspondente
            $analistas[$analista]['total_seconds'] += $totalSeconds;
            $analistas[$analista]['count'] += 1;
        }

        // Calculando a média de time_assigned para cada analista
        $medias = [];
        foreach ($analistas as $analista => $dados) {
            $mediaSegundos = $dados['total_seconds'] / $dados['count'];

            // Calculando horas, minutos e segundos
            $hours = floor($mediaSegundos / 3600);
            $minutes = floor(($mediaSegundos % 3600) / 60);
            $seconds = $mediaSegundos % 60;

            // Guardando as médias como uma string de horas, minutos e segundos
            $medias[$analista] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        // Passando as médias calculadas e os nomes dos analistas para a view
        return $this->renderizarView('media-time-assigned', [
            'analistas' => array_keys($medias),
            'medias' => array_values($medias),
        ]);
    }
}
