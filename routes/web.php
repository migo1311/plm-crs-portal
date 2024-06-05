<?php

use Illuminate\Support\Facades\Route;
use \App\Filament\Pages\CreateSchedule;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crs/schedule/create', [CreateSchedule::class, 'render'])
    ->name('filament.pages.create-schedule');
