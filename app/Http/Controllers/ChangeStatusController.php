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
        // Quantidade de registros por página
        $perPage = 20;

        // Chamando o método listar() e utilizando a paginação
        $changesCollection = collect(ChangeStatusDTO::listar()); // Converte para uma coleção para usar paginação

        // Criando a paginação manualmente
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $changes = $changesCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Formatando as datas e calculando o time_assigned em hh:mm:ss
        foreach ($changes as $change) {
            // Formatando as datas
            $change->earliest_submit_date = Carbon::parse($change->earliest_submit_date)->format('d/m/Y H:i:s');
            $change->min_createdate = Carbon::parse($change->min_createdate)->format('d/m/Y H:i:s');

            // Convertendo time_assigned (em dias) para horas, minutos e segundos
            $totalSeconds = $change->time_assigned * 24 * 60 * 60; // converter dias para segundos

            // Calculando horas, minutos e segundos
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            // Formatando o time_assigned em hh:mm:ss
            $change->time_assigned = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        // Criar a paginação com LengthAwarePaginator
        $paginatedChanges = new LengthAwarePaginator(
            $changes, // Os itens da página atual
            $changesCollection->count(), // Total de itens
            $perPage, // Quantidade de itens por página
            $currentPage, // Página atual
            ['path' => LengthAwarePaginator::resolveCurrentPath()] // Caminho para paginação correta
        );

        // Chamando a função media() para obter as médias por analista
        $mediaData = $this->media();  // Obtém os nomes e médias dos analistas

        // Mesclando os dados de 'changes' com as médias
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

            // Se o analista ainda não estiver no array, inicializamos com um array vazio
            if (!isset($analistas[$analista])) {
                $analistas[$analista] = [
                    'total_seconds' => 0,
                    'count' => 0,
                    'repeticoes' => 0 // Adicionando contador de repetições
                ];
            }

            // Convertendo time_assigned (em dias) para segundos
            $totalSeconds = $change->time_assigned * 24 * 60 * 60;

            // Adicionando o tempo e incrementando a contagem de repetições
            $analistas[$analista]['total_seconds'] += $totalSeconds;
            $analistas[$analista]['count'] += 1;
            $analistas[$analista]['repeticoes'] += 1; // Incrementando repetições
        }

        // Inicializando arrays para armazenar os analistas, suas médias e repetições
        $nomesAnalistas = [];
        $medias = [];
        $repeticoes = [];

        // Calculando a média de time_assigned e coletando o número de repetições para cada analista
        foreach ($analistas as $analista => $dados) {
            $mediaSegundos = $dados['total_seconds'] / $dados['count'];

            // Calculando horas, minutos e segundos
            $hours = floor($mediaSegundos / 3600);
            $minutes = floor(($mediaSegundos % 3600) / 60);
            $seconds = $mediaSegundos % 60;

            // Guardando as médias e as repetições
            $analista = ucwords(str_replace(".", " ", $analista));
            $nomesAnalistas[] = $analista;  // Lista de nomes de analistas
            $medias[] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);  // Média formatada para o analista
            $repeticoes[] = $dados['repeticoes']; // Número de vezes que o analista aparece
        }

        // Retornando um array em vez de um JSON, incluindo as repetições
        return compact('nomesAnalistas', 'medias', 'repeticoes');
    }
}
