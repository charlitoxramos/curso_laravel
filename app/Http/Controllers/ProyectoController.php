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
        //return $request->all();
        $proyecto = new Proyecto;
        $proyecto->nombre=$request->input('nombre_proyecto');
        $proyecto->fuente=$request->input('fuente_fondos');
        $proyecto->planificado=$request->input('monto_planificado');
        $proyecto->patrocinado=$request->input('monto_patrocinado');
        $proyecto->propios=$request->input('monto_fondos_propios');
        $proyecto->save();
        //return redirect()->back();
        return "ok"; 
    }

}
