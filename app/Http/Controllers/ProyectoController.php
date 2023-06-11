<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use PDF;


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

    //public function getPDF(Request $request){
    public function getPDF($id){
        
        $proyecto = Proyecto::find($id);
        
        $nombre = $proyecto->nombre;
        $fuente = $proyecto->fuente;
        $planificado = "$".number_format($proyecto->planificado,2);
        $patrocinado = "$".number_format($proyecto->patrocinado,2);
        $propios = "$".number_format($proyecto->propios,2);

        $data = [
            'nombre' => $nombre,
            'fuente' => $fuente,
            'planificado' => $planificado,
            'patrocinado' => $patrocinado,
            'propios' => $propios,
        ];
        
        date_default_timezone_set('America/El_Salvador');
        $fecha_hora = date("F j, Y, g:i a");

        $pdf = PDF::loadView('DocumentoPDF', compact('fecha_hora', 'nombre', 'fuente', 'planificado', 'patrocinado', 'propios'));
        //$pdf = PDF::loadView('DocumentoPDF');
        return $pdf->stream('Proyecto.pdf');   
    }

}
