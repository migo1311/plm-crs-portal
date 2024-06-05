<?php

use App\Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Route;
use \App\Filament\Pages\CreateSchedule;
use Filament\Http\Middleware\Authenticate;


Route::get('/crs/schedule/create', [CreateSchedule::class, 'render'])
    ->name('filament.pages.create-schedule');
