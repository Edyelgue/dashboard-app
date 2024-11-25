<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusDTO;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    public function renderizarView($view, $data = [])
    {
        return view($view, $data);
    }

    public function index(Request $request)
    {
        // Capturando os filtros de data
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Obter a lista de changes com os filtros
        $changes = ChangeStatusDTO::listar($startDate, $endDate);

        // Formatar os campos conforme necessário
        foreach ($changes as $change) {
            $change->earliest_submit_date = Carbon::parse($change->earliest_submit_date)->format('d/m/Y H:i:s');
            $change->min_createdate = Carbon::parse($change->min_createdate)->format('d/m/Y H:i:s');
            $change->finished_datetime = Carbon::parse($change->finished_datetime)->format('d/m/Y H:i:s');

            // Convertendo os tempos de dias para HH:MM:SS
            $change->time_assigned = gmdate('H:i:s', $change->time_assigned * 24 * 60 * 60);
            if (isset($change->time_finished)) {
                $change->time_finished = gmdate('H:i:s', $change->time_finished * 24 * 60 * 60);
            }
        }

        // Obter os dados de média e as contagens (se aplicável)
        $mediaData = $this->media();

        // Renderizar a view com os dados
        return $this->renderizarView('time-assigned', array_merge(['changes' => $changes], $mediaData));
    }

    public function media()
    {
        // Chamando o metodo listar()
        $changes = ChangeStatusDTO::listar();

        // Inicializando array para agrupar os tempos e a contagem por analista
        $analistas = [];

        foreach ($changes as $change) {
            $analista = $change->worklogsubmitter;
            $finishedAnalista = $change->finished_worklogsubmitter;

            // Se o analista ainda não estiver no array, inicializamos com um array vazio
            if (!isset($analistas[$analista])) {
                $analistas[$analista] = [
                    'total_seconds_assigned' => 0,
                    'total_seconds_finished' => 0,  // Para armazenar time_finished
                    'count' => 0,
                    'repeticoes' => 0, // Contador de repetições de worklogsubmitter == finished_worklogsubmitter
                    'same_as_finished_count' => 0 // Contador de vezes que worklogsubmitter == finished_worklogsubmitter
                ];
            }

            // Convertendo time_assigned (em dias) para segundos
            $totalSecondsAssigned = $change->time_assigned * 24 * 60 * 60;

            // Se time_finished estiver definido, convertê-lo em segundos
            $totalSecondsFinished = isset($change->time_finished) ? $change->time_finished * 24 * 60 * 60 : 0;

            // Adicionando o tempo de assigned e finished
            $analistas[$analista]['total_seconds_assigned'] += $totalSecondsAssigned;
            $analistas[$analista]['total_seconds_finished'] += $totalSecondsFinished;

            // Incrementando a contagem de repetições
            $analistas[$analista]['count'] += 1;
            $analistas[$analista]['repeticoes'] += 1; // Incrementando repetições

            // Contando se worklogsubmitter é igual a finished_worklogsubmitter
            if ($analista === $finishedAnalista) {
                $analistas[$analista]['same_as_finished_count'] += 1; // Incrementa se os analistas forem iguais
            }
        }

        // Inicializando arrays para armazenar os analistas, suas médias e contagens
        $nomesAnalistas = [];
        $mediasAssigned = [];
        $mediasFinished = [];
        $repeticoes = [];
        $sameAsFinishedCount = [];

        // Calculando a média de time_assigned e time_finished para cada analista
        foreach ($analistas as $analista => $dados) {
            $mediaSegundosAssigned = $dados['total_seconds_assigned'] / $dados['count'];
            $mediaSegundosFinished = $dados['total_seconds_finished'] / $dados['count']; // Média de time_finished

            // Calculando horas, minutos e segundos para time_assigned
            $hoursAssigned = floor($mediaSegundosAssigned / 3600);
            $minutesAssigned = floor(($mediaSegundosAssigned % 3600) / 60);
            $secondsAssigned = $mediaSegundosAssigned % 60;

            // Calculando horas, minutos e segundos para time_finished
            $hoursFinished = floor($mediaSegundosFinished / 3600);
            $minutesFinished = floor(($mediaSegundosFinished % 3600) / 60);
            $secondsFinished = $mediaSegundosFinished % 60;

            // Guardando as médias e as contagens
            $analista = ucwords(str_replace(".", " ", $analista));
            $nomesAnalistas[] = $analista;  // Lista de nomes de analistas
            // Média formatada para time_assigned
            $mediasAssigned[] = sprintf('%02d:%02d:%02d', $hoursAssigned, $minutesAssigned, $secondsAssigned);
            // Média formatada para time_finished
            $mediasFinished[] = sprintf('%02d:%02d:%02d', $hoursFinished, $minutesFinished, $secondsFinished);
            $repeticoes[] = $dados['repeticoes']; // Número de vezes que o analista aparece
            // Número de vezes que worklogsubmitter == finished_worklogsubmitter
            $sameAsFinishedCount[] = $dados['same_as_finished_count'];
        }

        // Retornando um array em vez de um JSON,
        // incluindo as contagens de worklogsubmitter == finished_worklogsubmitter
        return compact(
            'nomesAnalistas',
            'mediasAssigned',
            'mediasFinished',
            'repeticoes',
            'sameAsFinishedCount'
        );
    }
}
