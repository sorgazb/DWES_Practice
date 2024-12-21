<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoC extends Controller
{
    function verPrestamos(){
        $prestamos = Prestamo::orderBy('fecha','DESC')->get();
        return view('prestamos',compact('prestamos'));
    }

    function vistaNuevos(){
        $libros = Libro::all();
        return view('nuevo',compact('libros'));
    }

    function vistaModificar($id){
        $prestamo = Prestamo::find($id);
        return view('modificar',compact('prestamo'));
    }

    function modificarPrestamo(Request $request, $id){
        $prestamo = Prestamo::find($id);
        if($prestamo != null){
            try{
                DB::transaction(function() use($prestamo,$request){
                    $prestamo->fecha = $request->fecha;
                    $prestamo->nombreCliente = $request->cliente;
                    $prestamo->fechaDevolucion = $request->fechaDevolucion;
                    if($prestamo->save()){
                        $libroPrestado = Libro::find($prestamo->libro_id);
                        $libroPrestado->numEjemplares = $libroPrestado->numEjemplares + 1;
                        if($libroPrestado->save()){

                        }else{
                            return back()->with('mensaje','errrroooor');
                        }
                    }
                });
                return redirect()->route('verPrestamos')->with('mensaje','Prestamo Modificado');
            }catch (\Throwable $th) {
                return back()->with('mensaje',$th->getMessage());
            }
        }else{
            return back()->with('mensaje','Error. No se encuentra el prestamo');

        }
    }

    function crearPrestamo(Request $request){
        $request->validate([
            "fecha"=>"required",
            "libro"=>"required",
            "cliente"=>"required",
        ]);
        // Creamos el objeto Prestamo
        $prestamo = new Prestamo();
        $prestamo->fecha = $request->fecha;
        $prestamo->libro_id = $request->libro;
        $prestamo->nombreCliente = $request->cliente;

        $libroPrestar = Libro::find($prestamo->libro_id);
        if($libroPrestar->numEjemplares >= 1 ){
            $prestamosCliente = Prestamo::where('nombreCliente',$request->cliente)->get();
            $prestamosSinDevolver = false;
            foreach($prestamosCliente as $prestamos){
                if($prestamos->fechaDevolucion == null){
                    $prestamosSinDevolver = true;
                }
            }
            if($prestamosSinDevolver == false){
                try{
                    DB::transaction(function() use($prestamo,$libroPrestar){
                        if($prestamo->save()){
                            $libroPrestar->numEjemplares = $libroPrestar->numEjemplares - 1;
                            if($libroPrestar->save()){

                            }
                        }
                    });
                    return redirect()->route('verPrestamos')->with('mensaje','Prestamo creado con exito');
                }catch (\Throwable $th) {
                    return back()->with('mensaje',$th->getMessage());
                }
            }else{
                return back()->with('mensaje','Error. El cliente tiene libros sin devolver');

            }
        }else{
            return back()->with('mensaje','Error. No hay suficientes libros para realizar el prestamo');
        }
    }
}
