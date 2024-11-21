<?php

use App\Http\Controllers\ChangeStatusAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/incidentes', [
    ChangeStatusAPIController::class, 
    'index'
])->name('incidentes.index');
