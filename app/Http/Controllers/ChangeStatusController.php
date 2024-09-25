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

        // Formatando as datas
        foreach ($changes as $change) {
            $change->createdate = Carbon::parse($change->createdate)->format('d/m/Y H:i:s');
            $change->modifieddate = Carbon::parse($change->modifieddate)->format('d/m/Y H:i:s');
        }

        // Passando os dados formatados para a view
        return view('time-assigned', ['changes' => $changes]);
    }
}

