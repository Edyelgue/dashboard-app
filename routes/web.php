<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\FinishedStatusController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/time-assigned', function () {
    return view('time-assigned');
});

Route::get('/tickets-analysts', function () {
    return view('tickets-analysts');
});

Route::get('/time-assigned', [ChangeStatusController::class, 'index'])
->name('time-assigned.index');

Route::get('/tickets-analysts', [FinishedStatusController::class, 'index'])
->name('tickets-analysts.index');
