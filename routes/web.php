<?php

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartidasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthLoginController::class, 'store'])->name('login.post');
Route::get('/salir', [AuthLoginController::class, 'logout'])->name('salir');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/partidas', [PartidasController::class, 'index'])->name('partidas');
    Route::resource('partes-diarios', ParteDiarioController::class);
    
});
