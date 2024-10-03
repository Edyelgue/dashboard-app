<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeStatusController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/time-assigned', function () {
    return view('time-assigned');
});

Route::get('/tickets-assigned', function () {
    return view('tickets-assigned');
});

Route::get('/time-assigned', [ChangeStatusController::class, 'index'])
->name('time-assigned.index');
