<?php

namespace App\Http\Controllers;

use App\Http\Resources\CitaResource;
use App\Models\Cita;
use App\Models\DetalleCita;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $cita = Cita :: all();
            return CitaResource::collection($cita);
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'fecha'=>'required',
            'fecha'=>'after_or_equal:today', // La fecha de la cita debe ser o hoy u otro dia posterior
            'hora'=>'required',
            'cliente'=>'required'
        ]);
        // Creamos la cita
        try{
            $cita = new Cita();
            $cita->fecha = $request->fecha;
            $cita->hora = $request->hora;
            $cita->cliente = $request->cliente;   
            if($cita->save()){
                return response()->json('Cita creada',200);
            }
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try{
            $cita = Cita::find($request->id);
            if($cita->finalizada == 0){
                $cita->finalizada = 1;
                if($cita->save()){
                    return response()->json('Cita actualizada',200);
                }
            }else{
                return response()->json('La cita ya fue finalizada',500);
            }
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Cita $cita)
    {
        //
        try{
            $cita = Cita::find($request->id);
            $detalleCita = DetalleCita::where('cita_id',$cita->id)->first();
            if($detalleCita == null){
                if($cita->delete()){
                    return response()->json('Cita eliminada',200);
                }
            }else{
                return response()->json('La cita tiene servicios asignados',500);
            }
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }

    }
}
