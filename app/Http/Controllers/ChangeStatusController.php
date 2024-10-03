<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusDTO;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ChangeStatusController extends Controller
{
    public function renderizarView($view, $data = [])
    {
        return view($view, $data);
    }

    public function index()
    {
        $perPage = 20;
    
        // Obter a lista de changes
        $changesCollection = collect(ChangeStatusDTO::listar());
    
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $changes = $changesCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
    
        foreach ($changes as $change) {
            $change->earliest_submit_date = Carbon::parse($change->earliest_submit_date)->format('d/m/Y H:i:s');
            $change->min_createdate = Carbon::parse($change->min_createdate)->format('d/m/Y H:i:s');
    
            $totalSeconds = $change->time_assigned * 24 * 60 * 60;
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;
            $change->time_assigned = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
    
        $paginatedChanges = new LengthAwarePaginator(
            $changes,
            $changesCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    
        // Obter os dados de média e as contagens
        $mediaData = $this->media();
    
        // Passando os dados para a view
        return $this->renderizarView('time-assigned', array_merge(['changes' => $paginatedChanges], $mediaData));
    } 

    public function media()
    {
        // Chamando o método listar()
        $changes = ChangeStatusDTO::listar();

        // Inicializando array para agrupar os tempos e a contagem por analista
        $analistas = [];

        foreach ($changes as $change) {
            $analista = $change->worklogsubmitter;
            $finishedAnalista = $change->finished_worklogsubmitter;

            // Se o analista ainda não estiver no array, inicializamos com um array vazio
            if (!isset($analistas[$analista])) {
                $analistas[$analista] = [
                    'total_seconds' => 0,
                    'count' => 0,
                    'repeticoes' => 0, // Contador de repetições de worklogsubmitter == finished_worklogsubmitter
                    'same_as_finished_count' => 0 // Contador de vezes que worklogsubmitter == finished_worklogsubmitter
                ];
            }

            // Convertendo time_assigned (em dias) para segundos
            $totalSeconds = $change->time_assigned * 24 * 60 * 60;

            // Adicionando o tempo e incrementando a contagem de repetições
            $analistas[$analista]['total_seconds'] += $totalSeconds;
            $analistas[$analista]['count'] += 1;
            $analistas[$analista]['repeticoes'] += 1; // Incrementando repetições

            // Contando se worklogsubmitter é igual a finished_worklogsubmitter
            if ($analista === $finishedAnalista) {
                $analistas[$analista]['same_as_finished_count'] += 1; // Incrementa se os analistas forem iguais
            }
        }

        // Inicializando arrays para armazenar os analistas, suas médias e contagens
        $nomesAnalistas = [];
        $medias = [];
        $repeticoes = [];
        $sameAsFinishedCount = [];

        // Calculando a média de time_assigned e coletando o número de repetições para cada analista
        foreach ($analistas as $analista => $dados) {
            $mediaSegundos = $dados['total_seconds'] / $dados['count'];

            // Calculando horas, minutos e segundos
            $hours = floor($mediaSegundos / 3600);
            $minutes = floor(($mediaSegundos % 3600) / 60);
            $seconds = $mediaSegundos % 60;

            // Guardando as médias e as contagens
            $analista = ucwords(str_replace(".", " ", $analista));
            $nomesAnalistas[] = $analista;  // Lista de nomes de analistas
            $medias[] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);  // Média formatada para o analista
            $repeticoes[] = $dados['repeticoes']; // Número de vezes que o analista aparece
            $sameAsFinishedCount[] = $dados['same_as_finished_count']; // Número de vezes que worklogsubmitter == finished_worklogsubmitter
        }

        // Retornando um array em vez de um JSON, incluindo as contagens de worklogsubmitter == finished_worklogsubmitter
        return compact('nomesAnalistas', 'medias', 'repeticoes', 'sameAsFinishedCount');
    }
}
