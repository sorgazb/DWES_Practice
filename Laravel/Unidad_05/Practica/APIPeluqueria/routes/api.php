<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\DetalleCitaController;
use App\Http\Controllers\ServicioController;
use App\Models\DetalleCita;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('cita',[CitaController::class,'index']);
Route::post('cita',[CitaController::class,'store']);
Route::get('detalleCita',[DetalleCitaController::class,'index']);
Route::get('servicio',[ServicioController::class,'index']);
Route::get('detalleCita/{cita_id}',[DetalleCitaController::class,'obtenerDetalleCita']);
Route::post('detalleCita',[DetalleCitaController::class,'store']);
Route::delete('detalleCita/{id}',[DetalleCitaController::class,'destroy']);
Route::put('cita/{id}',[CitaController::class,'update']);
Route::delete('cita/{id}',[CitaController::class,'destroy']);
Route::get('servicio',[ServicioController::class,'index']);