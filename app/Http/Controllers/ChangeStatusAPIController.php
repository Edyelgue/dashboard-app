<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusAPI;
use Illuminate\Http\Request;

class ChangeStatusAPIController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Captura os parâmetros de data da requisição
            $startDate = $request->query('startDate');
            $endDate = $request->query('endDate');

            // Recupera os dados baseados nas datas (ou todos os incidentes)
            $incidentes = ($startDate && $endDate)
                ? ChangeStatusAPI::listar(
                    $startDate,
                    $endDate
                )
                : ChangeStatusAPI::listar();

            // Retorna a view com os dados
            return view('incidentes', [
                'incidentes' => $incidentes
            ]);
        } catch (\Exception $e) {
            // Em caso de erro, redireciona para uma página de erro ou exibe uma mensagem
            return redirect()->back()->withErrors([
                'message' => 'Erro ao listar incidentes: ' . $e->getMessage()
            ]);
        }
    }
}
