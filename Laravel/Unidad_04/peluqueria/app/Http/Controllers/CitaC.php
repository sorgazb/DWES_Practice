<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Servicio;
use Illuminate\Http\Request;

class CitaC extends Controller
{

    function verCitas(){
        $citas = Cita::orderBy('fecha','DESC')->orderBy('hora')->get();
        return view('citas',compact('citas'));
    }

    function modificarCita(Request $request,$id){
        $cita = Cita::find($id);
        if($cita != null){
            // CAlculamos total
            foreach($cita->obtenerDetalle() as $d){
                $cita->total += $d->precio;
            }
            // Guardamos cambios
            if($cita->save()){
                return back()->with('mensaje','Cita Finalizada');
            }else{
                return back()->with('mensaje','ERROR.Al Finalizar la cita');
            }
        }else{
            return back()->with('mensaje','ERROR. No existe la cita');
        }
    }

    function borrarCita(Request $request,$id){
        // Recuperar la cita
        $cita = Cita::find($id);
        if($cita != null){
            if(empty($cita->obtenerDetalle())){
                if($cita->delete()){
                    return back()->with('mensaje','Se ha borrado la cita con ID '.$cita->id);
                }else{
                    return back()->with('mensaje','ERROR. No se ha podido borrar la cita');
                }
            }else{
                return back()->with('mensaje','ERROR. No se puede borrar una cita que tenda servicios');
            }
        }else{
            return back()->with('mensaje','ERROR. No existe la cita');
        }
    }

    function crearCita(Request $request){
        // Validador
        $request->validate([
            "fecha"=>"required",
            "hora"=>"required",
            "cliente"=>"required"
        ]);

        $cita = new Cita();
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->cliente = $request->cliente;
        if($cita->save()){
            return back()->with('mensaje','Cita con id '.$cita->id.' para el cliente '.$cita->cliente.' creada');
        }else{
            return back()->with('mensaje','ERROR. No se ha creado la cita');
        }
    }

    function crearDetalle($id){
        $cita=Cita::find($id);
        $servicios = Servicio::all();
        if($cita != null){
            return view('detalle',compact('cita','servicios'));
        }else{
            return back()->with('mensaje','ERROR. No existe la cita');
        }
    }

    function aniadirDetalle(Request $request, $id){
        $cita = Cita::find($id);
        if($cita != null){
            $servicio = Servicio::find($request->servicio);
            if($servicio != null){
                // Crear Detalle
                $d = new DetalleCita();
                $d->cita_id = $cita->id;
                $d->servicio_id = $servicio->id;
                $d->precio = $servicio->precio;
                if($d->save()){
                    return back()->with('mensaje','Servicio Añadido');
                }else{
                    return back()->with('mensaje','ERROR. No se ha podido añadir el servicio');
                }
            }else{
                return back()->with('mensaje','ERROR. No existe el servicio');
            }
        }else{
            return back()->with('mensaje','ERROR. No existe la cita');
        }
    }
}
