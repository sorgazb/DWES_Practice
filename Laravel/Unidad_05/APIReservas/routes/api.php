<?php

use App\Http\Controllers\RecursosController;
use App\Http\Controllers\ReservasController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('recursos',[RecursosController::class,'index']);
Route::get('reservas',[ReservasController::class,'index']);
Route::post('reservas',[ReservasController::class,'store'])->withoutMiddleware([VerifyCsrfToken::class]);
