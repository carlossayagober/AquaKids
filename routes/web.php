<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ReporteController;

// Redirigir al login si nadie ha entrado
Route::get('/', fn() => redirect()->route('login'));

// Rutas públicas
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (Panel administrativo)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('niveles', NivelController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('entrenadores', EntrenadorController::class)->parameters(['entrenadores' => 'entrenador']);
    
    // Moviendo todo lo administrativo dentro del grupo 'auth'
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('asistencias', AsistenciaController::class);
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::resource('grupos', GrupoController::class);
});