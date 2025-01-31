<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocadoraController;

Route::resource('locadoras', LocadoraController::class);

// Rota para o método de pesquisa
Route::get('pesquisa', [LocadoraController::class, 'pesquisa']);
