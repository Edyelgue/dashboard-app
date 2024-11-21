<?php

use App\Http\Controllers\ChangeStatusAPIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\ChangeStatusNMController;
use App\Http\Controllers\FinishedStatusController;
use App\Http\Controllers\FinishedStatusNMController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/time-assigned', function () {
    return view('time-assigned');
});

Route::get('/tickets-analysts', function () {
    return view('tickets-analysts');
});

Route::get('/time-assigned', [
    ChangeStatusController::class,
    'index'
])->name('time-assigned.index');

Route::get('/tickets-analysts', [
    FinishedStatusController::class,
    'index'
])->name('tickets-analysts.index');

Route::get('/tickets-analysts-nm', [
    FinishedStatusNMController::class,
    'index'
])->name('tickets-analysts-nm.index');

Route::get('/time-assigned', [
    ChangeStatusController::class,
    'index'
])->name('time-assigned');

Route::get('/time-assigned-nm', [
    ChangeStatusNMController::class,
    'index'
])->name('time-assigned-nm');

Route::get('/incidentes', [
    ChangeStatusAPIController::class,
    'index'
])->name('f.incidentes.index');

Route::get('/change-status', [
    ChangeStatusAPIController::class,
    'index'
]);
