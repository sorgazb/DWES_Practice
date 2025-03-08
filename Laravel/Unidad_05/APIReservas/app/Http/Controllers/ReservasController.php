<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservaResource;
use App\Models\Recursos;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $reservas = Reservas::all();
            return ReservaResource::collection($reservas);
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
            'empleado'=>'required',
            'fechaI'=>'required',
            'fechaI'=>'before:fechaF',
            'fechaI'=>'after_or_equal:today',
            'fechaF'=>'required',
            'fechaF'=>'after:fechaI',
            'recurso_id'=>'required'
        ]);
        // Creamos la reserva
        try{
            $reserva = new Reservas();
            $reserva->empleado = $request->empleado;
            $reserva->fechaI = $request->fechaI;
            $reserva->fechaF = $request->fechaF;   
            $reserva->recurso_id = $request->recurso_id;
            if($reserva->save()){
                return response()->json('Reserva creada',200);
            }
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservas $reservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservas $reservas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservas $reservas)
    {
        //
    }
}
