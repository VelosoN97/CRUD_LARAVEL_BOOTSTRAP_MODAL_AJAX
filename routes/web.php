<?php

use App\Http\Controllers\JugadoresController;
use Illuminate\Support\Facades\Route;


Route::get('jugadores', [JugadoresController::class, 'index']);
Route::get('fetch-jugadores', [JugadoresController::class, 'fetchjugador']);
Route::post('jugadores', [JugadoresController::class, 'store']);
Route::get('editar-jugador/{id}', [JugadoresController::class, 'editar']);
Route::put('update-jugador/{id}', [JugadoresController::class, 'update']);
Route::delete('eliminar-jugador/{id}', [JugadoresController::class, 'eliminar']);

Route::get('/', function () {
    return view('welcome');
});
