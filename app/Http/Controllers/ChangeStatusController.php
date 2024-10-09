<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusDTO;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    public function renderizarView($view, $data = [])
    {
        return view($view, $data);
    }

    public function index()
    {
        $perPage = 20;

        // Verifique se já existe um cache dos dados na sessão
        if (!session()->has('changesCollection')) {
            // Se não houver, obtenha os dados e armazene na sessão
            $changesCollection = collect(ChangeStatusDTO::listar());
            session(['changesCollection' => $changesCollection]);
        } else {
            // Caso os dados já estejam na sessão, apenas os recupere
            $changesCollection = session('changesCollection');
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $changes = $changesCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Formatação dos campos
        foreach ($changes as $change) {
            $this->formatChangeData($change);
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

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $perPage = 20;

        // Construir a consulta SQL com filtragem
        $changesCollection = collect(ChangeStatusDTO::listar());
        $filteredChanges = $changesCollection->filter(function ($change) use ($searchTerm) {
            return stripos($change->incidentsummary, $searchTerm) !== false ||
                stripos($change->incidentid, $searchTerm) !== false ||
                stripos($change->status, $searchTerm) !== false ||
                stripos($change->worklogsubmitter, $searchTerm) !== false;
        });

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $changes = $filteredChanges->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Formatação dos campos
        foreach ($changes as $change) {
            $this->formatChangeData($change);
        }

        $paginatedChanges = new LengthAwarePaginator(
            $changes,
            $filteredChanges->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('partials.changes-tbody', ['changes' => $paginatedChanges]);
    }

    public function media()
    {
        $changes = ChangeStatusDTO::listar();

        // Inicializando array para agrupar os tempos e a contagem por analista
        $analistas = [];

        foreach ($changes as $change) {
            $analista = $change->worklogsubmitter;
            $finishedAnalista = $change->finished_worklogsubmitter;

            if (!isset($analistas[$analista])) {
                $analistas[$analista] = [
                    'total_seconds_assigned' => 0,
                    'total_seconds_finished' => 0,
                    'count' => 0,
                    'repeticoes' => 0,
                    'same_as_finished_count' => 0
                ];
            }

            $totalSecondsAssigned = $change->time_assigned * 24 * 60 * 60;
            $totalSecondsFinished = isset($change->time_finished) ? $change->time_finished * 24 * 60 * 60 : 0;

            $analistas[$analista]['total_seconds_assigned'] += $totalSecondsAssigned;
            $analistas[$analista]['total_seconds_finished'] += $totalSecondsFinished;
            $analistas[$analista]['count'] += 1;

            if ($analista === $finishedAnalista) {
                $analistas[$analista]['same_as_finished_count'] += 1;
            }
        }

        $nomesAnalistas = [];
        $mediasAssigned = [];
        $mediasFinished = [];
        $repeticoes = [];
        $sameAsFinishedCount = [];

        foreach ($analistas as $analista => $dados) {
            $mediaSegundosAssigned = $dados['total_seconds_assigned'] / $dados['count'];
            $mediaSegundosFinished = $dados['total_seconds_finished'] / $dados['count'];

            $nomesAnalistas[] = ucwords(str_replace(".", " ", $analista));
            $mediasAssigned[] = $this->formatTime($mediaSegundosAssigned);
            $mediasFinished[] = $this->formatTime($mediaSegundosFinished);
            $repeticoes[] = $dados['count'];
            $sameAsFinishedCount[] = $dados['same_as_finished_count'];
        }

        return compact('nomesAnalistas', 'mediasAssigned', 'mediasFinished', 'repeticoes', 'sameAsFinishedCount');
    }

    private function formatChangeData(&$change)
    {
        $change->earliest_submit_date = Carbon::parse($change->earliest_submit_date)->format('d/m/Y H:i:s');
        $change->min_createdate = Carbon::parse($change->min_createdate)->format('d/m/Y H:i:s');
        $change->finished_datetime = Carbon::parse($change->finished_datetime)->format('d/m/Y H:i:s');

        // Verifica se time_assigned é numérico antes de multiplicar
        if (is_numeric($change->time_assigned)) {
            $change->time_assigned = $this->formatTime($change->time_assigned * 24 * 60 * 60);
        } else {
            $change->time_assigned = '00:00:00';  // Valor padrão caso seja inválido
        }

        // Verifica se time_finished é definido e numérico antes de multiplicar
        if (isset($change->time_finished) && is_numeric($change->time_finished)) {
            $change->time_finished = $this->formatTime($change->time_finished * 24 * 60 * 60);
        } else {
            $change->time_finished = '00:00:00';  // Valor padrão caso seja inválido
        }
    }


    private function formatTime($totalSeconds)
    {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
