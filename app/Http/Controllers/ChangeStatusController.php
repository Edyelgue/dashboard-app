<?php

namespace App\Http\Controllers;

use App\Models\ChangeStatusDTO;

class ChangeStatusController extends Controller
{
    public function index()
    {
        // Chamando o método listar() e passando os dados para a view
        $changes = ChangeStatusDTO::listar();
        return view('time-assigned', ['changes' => $changes]);
    }
}
