<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetalleCitaResource;
use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DetalleCitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            return DetalleCita::all();
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }
    }

    public function obtenerDetalleCita(Request $request){
        //
        try{
            $detalleCita = DetalleCita::where('cita_id',$request->cita_id)->get();
            return DetalleCitaResource::collection($detalleCita);
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
            'cita_id'=>'required',
            'servicio_id'=>'required',
        ]);

        try{
            $cita = Cita::find($request->cita_id);
            if($cita->finalizada == 0){
                $detalleCita = new DetalleCita();
                $detalleCita->cita_id = $request->cita_id;
                $detalleCita->servicio_id = $request->servicio_id;
                $servicio = Servicio::find($request->servicio_id);
                $detalleCita->precio = $servicio->precio;
                if($detalleCita->save()){
                    return response()->json('Detalle Cita creado',200);
                }
            }else{
                return response()->json('La cita ya fue finalizada',500);
            }
        }catch(\Throwable $th){
            return response()->json('Error '.$th->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleCita $detalleCita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleCita $detalleCita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        try {
            $detalleCita = DetalleCita::find($request->id);
            $cita = Cita::find($detalleCita->cita_id);
            if($cita->finalizada == 0){
                if($detalleCita->delete()){
                    return response()->json('Detalle Borrado',200);
                }
            }else{
                return response()->json('La cita ya fue finalizada',500);
            }
        } catch (\Throwable $th) {
            return response()->json('Error:'.$th->getMessage(),500);
        }
    }
}
