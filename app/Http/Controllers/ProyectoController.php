<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function lista(){
        $proyecto = Proyecto::all();
        return $proyecto;
       
    }

    public function crear(Request $request){
        $proyecto = new Proyecto;
        $proyecto->nombre=$request->nombre;
        $proyecto->fuente=$request->fuente;
        $proyecto->planificado=$request->planificado;
        $proyecto->patrocinado=$request->patrocinado;
        $proyecto->propios=$request->propios;
        $proyecto->save();
        return response()->json(['Respuesta'=>'Ok']); 
    }

    public function editar(Request $request){
        Proyecto::find($request->id)->update([
            'nombre' => $request->nombre,
            'fuente' => $request->fuente,
            'planificado' => $request->planificado,
            'patrocinado' => $request->patrocinado,
            'propios' => $request -> propios,
        ]);
        return response()->json(['Respuesta'=>'Ok']); 
    }

    public function eliminar(Request $request){
        Proyecto::destroy($request->id);
        return response()->json(['Respuesta'=>'Ok']);
        //return back(); 
        //return $request->all();
    }

}
