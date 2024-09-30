<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\IncidentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/time-assigned', function () {
    return view('time-assigned');
});

Route::get('/time-assigned', [ChangeStatusController::class, 'index'])
->name('time-assigned.index');

Route::get('/incidentes-ultimos-7-dias', [IncidentController::class, 'listarUltimos7Dias']);
