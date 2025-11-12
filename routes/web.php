<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcuarioController;
use App\Livewire\Control\ControlAcuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

Route::get('/api/check-commands', [AcuarioController::class, 'checkCommands']);

/* Route::get('/control', ControlAcuario::class)
    ->name('control.control-acuario'); */


require __DIR__.'/auth.php';
