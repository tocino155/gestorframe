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
        $pacientes=DB::table("pacientes")->select("*")->get();
        $pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
        $medicos=DB::table("medicos")->select("*")->get();
        $especialidades=DB::table("cat_especialidades")->select("*")->get();
        $areas=DB::table("cat_areas")->select("*")->get();
        $paises=DB::table("paises")->select("*")->get();
        return view("alta.dar_de_alta",compact('pacientes','medicos','especialidades','areas','paises','pacientes_asignaciones'));
    }
    public function guardar_paciente(Request $request){

        $time = date("d-m-Y")."-".time();

        if($request['foto']!=null){
            $foto = $time.''.rand(11111,99999).'foto'.'.png'; 
            $destinationPath = public_path().'/archivos_pacientes_ingreso';
        }else{
            $foto=null;
        }
        if($request['foto']!=null){
            $file_image = $request->file('foto');
            $file_image->move($destinationPath,$foto);
        }
        //antecedentes
        if($request['antecedentes']!=null){
            $archivo = $time.''.rand(11111,99999).'antecedentes'.'.pdf'; 
            $destinationPath = public_path().'/archivos_pacientes_ingreso';
        }else{
            $archivo=null;
        }
        if($request['antecedentes']!=null){
            $file_image = $request->file('antecedentes');
            $file_image->move($destinationPath,$archivo);
        }

        DB::table("pacientes")->insert([

            "nombre"=>$request['nombre'],
            "apellido_pat"=>$request['ape_pat'],
            "apellido_mat"=>$request['ape_mat'],
            "fecha_nacimiento"=>$request['fecha'],
            "fecha_ingreso"=>date("Y-m-d"),
            "domicilio"=>$request['domicilio'],
            "id_pais"=>$request['pais'],
            "telefono"=>$request['tel'],
            "correo"=>$request['correo'],
            "estado"=>$request['estado'],
            "delegacion"=>$request['delegacion'],
            "colonia"=>$request['colonia'],
            "delegacion"=>$request['delegacion'],
            "cp"=>$request['cp'],
            "foto"=>$foto,
            "ATE_clinicos"=>$archivo,
            "id_estatus"=>1,
            "observaciones"=>$request['observaciones']
        ]);

        return redirect()->back()->with(['message' => 'Paciente Guardado con éxito', 'color' => 'success']);
    }


    public function actualizar_paciente(Request $request){

        $time = date("d-m-Y")."-".time();

        if($request['foto']!=null){
            $foto = $time.''.rand(11111,99999).'foto'.'.png'; 
            $destinationPath = public_path().'/archivos_pacientes_ingreso';
        }else{
            $foto=$request['foto_old'];
        }
        if($request['foto']!=null){
            $file_image = $request->file('foto');
            $file_image->move($destinationPath,$foto);
        }
        //antecedentes
        if($request['antecedentes']!=null){
            $archivo = $time.''.rand(11111,99999).'antecedentes'.'.pdf'; 
            $destinationPath = public_path().'/archivos_pacientes_ingreso';
        }else{
            $archivo=$request['antecedentes_old'];
        }
        if($request['antecedentes']!=null){
            $file_image = $request->file('antecedentes');
            $file_image->move($destinationPath,$archivo);
        }


        DB::table("pacientes")->where("id",$request['id_pasiente'])->update([

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
            "foto"=>$foto,
            "ATE_clinicos"=>$archivo,
            "observaciones"=>$request['observaciones']
        ]);

        return redirect()->back()->with(['message' => 'Paciente Actualizado con éxito', 'color' => 'warning']);
    }

    public function eliminar_paciente(Request $request){
        DB::table('pacientes')->delete($request['id_pasiente_eliminar']);
        return redirect()->back()->with(['message' => 'Paciente Eliminado con éxito', 'color' => 'danger']);
    }

    public function guardar_medico(Request $request){
        DB::table("medicos")->insert([

            "nombre"=>$request['nombre'],
            "apellido_pat"=>$request['ape_pat'],
            "apellido_mat"=>$request['ape_mat'],
            "id_especialidad"=>$request['especialidad'],
            "dia_inicio"=>"Lunes",
            "dia_final"=>"Domingo",
            "hora_inicio"=>"07:00:00",
            "hora_final"=>"22:00:00"
        ]);

        return redirect()->back()->with(['message' => 'Medico Guardado con éxito', 'color' => 'success']);
    }

    public function actualizar_medico(Request $request){
        DB::table("medicos")->where("id",$request['id_medico'])->update([

            "nombre"=>$request['nombre'],
            "apellido_pat"=>$request['ape_pat'],
            "apellido_mat"=>$request['ape_mat'],
            "id_especialidad"=>$request['especialidad']
        ]);

        return redirect()->back()->with(['message' => 'Medico Actualizado con éxito', 'color' => 'warning']);
    }

    public function eliminar_medico(Request $request){
        DB::table('medicos')->delete($request['id_medico_eliminar']);
        return redirect()->back()->with(['message' => 'Medico Eliminado con éxito', 'color' => 'danger']);
    }
}
