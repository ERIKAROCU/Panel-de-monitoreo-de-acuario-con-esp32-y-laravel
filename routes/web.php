<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcuarioController;
use App\Livewire\Control\ControlAcuario;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/api/check-commands', [AcuarioController::class, 'checkCommands']);

/* Route::get('/control', ControlAcuario::class)
    ->name('control.control-acuario'); */


require __DIR__.'/auth.php';
