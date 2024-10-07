<?php

namespace App\Http\Controllers;

use App\Models\FinishedStatusDTO;

class FinishedStatusController extends Controller
{
    public function renderizarView($view, $data = [])
    {
        return view($view, $data);
    }

    public function index()
    {
        // Obter todos os dados agregados de tickets do DTO
        $ticketsGrouped = FinishedStatusDTO::getTicketsGroupedByStatus();

        $data = [];
        $analysts = [];

        // Iterar sobre os resultados agrupados e preparar os dados para a view
        foreach ($ticketsGrouped as $analyst => $tickets) {
            $totalClosed = 0;
            $totalCancelled = 0;
            $totalTickets = 0;

            foreach ($tickets as $ticket) {
                if ($ticket->status === 'fechado') {
                    $totalClosed = $ticket->total;
                } elseif ($ticket->status === 'cancelado') {
                    $totalCancelled = $ticket->total;
                }
                // Somar todos os tickets independentemente do status
                $totalTickets += $ticket->total;
            }

            // Preencher o array com as contagens por analista
            $data[$analyst] = [
                'name' => $analyst,
                'total_closed' => $totalClosed,
                'total_cancelled' => $totalCancelled,
                'total_tickets' => $totalTickets,
            ];

            $analysts[] = $analyst;
        }

        $chartData = [
            'labels' => $analysts,
            'datasets' => [
                [
                    'label' => 'Tickets Fechados',
                    'data' => array_column($data, 'total_closed'),
                ],
                [
                    'label' => 'Tickets Cancelados',
                    'data' => array_column($data, 'total_cancelled'),
                ],
                [
                    'label' => 'Total de Tickets',
                    'data' => array_column($data, 'total_tickets'),
                ],
            ],
        ];

        // Renderizar a view 'tickets-analysts' passando os dados agregados
        return $this->renderizarView('tickets-analysts', [
            'chartData' => json_encode($chartData), // Encode para JSON
        ]);
    }
}
