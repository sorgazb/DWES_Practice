<?php

use App\Http\Controllers\PrestamoC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('verPrestamos');
});

// Creamos el grupo de rutas
Route::controller(PrestamoC::class)->group(
    function(){
        Route::get('prestamos','verPrestamos')->name('verPrestamos');
        Route::get('nuevo','vistaNuevos')->name('vistaNuevos');
        Route::post('nuevo','crearPrestamo')->name('crearPrestamo');

        Route::get('modificar/{id}','vistaModificar')->name('vistaModificar');
        Route::put('modificar/{id}','modificarPrestamo')->name('modificarPrestamo');
    }
);
