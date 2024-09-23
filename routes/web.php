<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/time-assigned', function () {
    return view('time-assigned');
});