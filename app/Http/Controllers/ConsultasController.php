<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    //
public function __construct(){

        $this->middleware("auth");
        //$this->middleware("auth")->only("nombre_funcion","otro_motodo",....);
    }

    public function VerConsultas(){
        $pacientes=DB::table("pacientes")->select("*")->get();
        $medicos=DB::table("medicos")->select("*")->get();
        $especialidades=DB::table("cat_especialidades")->select("*")->get();
        $areas=DB::table("cat_areas")->select("*")->get();
        $paises=DB::table("paises")->select("*")->get();
        $estatus=DB::table("cat_estatus")->select("*")->get();
        $procedimientos=DB::table("cat_procedimiento_costo")->select("*")->get();
        return view("Consultas.Consulta",compact('pacientes','medicos','especialidades','areas','paises','estatus','procedimientos'));
    }

    public function guardar_asignacion(Request $request){

        DB::table("pacientes")->where("id",$request['id_paciente'])->update([
            "id_estatus"=>2
        ]);

        DB::table("pacientes_asignaciones")->insert([

            "id_paciente"=>$request['id_paciente'],
            "id_especialidad"=>$request['especialidad'],
            "id_medico"=>$request['medico'],
            "observaciones"=>$request['observaciones'],
            "id_procedimiento"=>$request['procedimiento']
        ]);
        return redirect()->back()->with(['message' => 'Asignado con éxito', 'color' => 'success']);
    }


}
