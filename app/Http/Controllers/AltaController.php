<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AltaController extends Controller
{
    public function __construct(){

        $this->middleware("auth");
        //$this->middleware("auth")->only("nombre_funcion","otro_motodo",....);
    }

    public function vista_alta(){
        $pasientes=DB::table("pasientes")->select("*")->get();
        return view("alta.dar_de_alta",compact('pasientes'));
    }
    public function guardar_pasiente(Request $request){
        DB::table("pasientes")->insert([

            "nombre"=>$request['nombre'],
            "apellido_pat"=>$request['ape_pat'],
            "apellido_mat"=>$request['ape_mat'],
            "fecha_nacimiento"=>$request['fecha'],
            "domicilio"=>$request['domicilio'],
            "id_pais"=>$request['pais'],
            "telefono"=>$request['tel'],
            "correo"=>$request['correo'],
            "estado"=>$request['estado'],
            "delegacion"=>$request['delegacion'],
            "colonia"=>$request['colonia'],
            "delegacion"=>$request['delegacion'],
            "cp"=>$request['cp'],
            "observaciones"=>$request['observaciones']
        ]);

        return redirect()->back()->with(['message' => 'Paciente Guardado con éxito', 'color' => 'success']);
    }

    public function eliminar_pasiente(Request $request){
        echo $request['id_pasiente_eliminar'];
        //DB::table('pasientes')->delete($request['id_pasiente_eliminar']);
        //return redirect()->back()->with(['message' => 'Paciente Eliminado con éxito', 'color' => 'danger']);
    }
}
