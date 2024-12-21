<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('holamundo');
});

Route::get('/alumnos', function () {
    return'Bienvenidos Alumnos';
});

Route::get('/alumnos/{nombre}', function ($nombreA) {
    return'Bienvenido '.$nombreA.'.';
});

Route::get('/alumnos/insertar/{nombre}', function ($nombreA) {
    return'Página para crear alumno '.$nombreA.'.';
});