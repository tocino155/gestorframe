<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CatalogosController extends Controller
{
    public function __construct(){

        $this->middleware("auth");
        //$this->middleware("auth")->only("nombre_funcion","otro_motodo",....);
    }
//area

    public function VerAreas(){
    $pacientes=DB::table("pacientes")->select("*")->get();
    $pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
    $areas=DB::table('cat_areas')->select('*')->get();
    $especialidades=DB::table('cat_especialidades')->select('*')->get();
    return view("Catalogos.Areas",compact('areas','especialidades','pacientes','pacientes_asignaciones'));
    }

    public function save_area(Request $request){
    $maxId = DB::table('cat_areas')->max('id');
    DB::statement('ALTER TABLE cat_areas AUTO_INCREMENT=' . intval($maxId + 1) . ';');
        DB::table("cat_areas")->insert([

            "Area"=>$request['nombre-area'],
            "Especialidad"=>$request['especialidad'],

        ]);

        return redirect()->back()->with('message','Area Guardado con éxito', );
    }

       public function delete_area($id){
        
        DB::table('cat_areas')->delete($id);    

        return redirect()->back()->with('msjdelete','El Area fue Eliminado con éxito', );
    }

     public function update_area(Request $request,$id){
        
DB::table("cat_areas")->where('id',$id)->update([

            "Area"=>$request['nombre-area'],
            "Especialidad"=>$request['especialidad'],

        ]);

        return redirect()->back()->with('msjdelete','El Area fue Actualizado con éxito', );
    }

//aseguradora
    public function VerAseguradoras(){
    $pacientes=DB::table("pacientes")->select("*")->get();
    $pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
    $areas=DB::table('cat_areas')->select('*')->get();
    $especialidades=DB::table('cat_especialidades')->select('*')->get();
$aseguradoras=DB::table('cat_aseguradoras')->select('*')->get();
        return view("Catalogos.Aseguradoras",compact('aseguradoras','areas','especialidades','pacientes','pacientes_asignaciones'));
    }

     public function save_asegu(Request $request){
        $maxId = DB::table('cat_aseguradoras')->max('id');
    DB::statement('ALTER TABLE cat_aseguradoras AUTO_INCREMENT=' . intval($maxId + 1) . ';');
        DB::table("cat_aseguradoras")->insert([

            "Aseguradora"=>$request['nombre-asegu'],
            "Porcentaje"=>$request['porcentaje'],

        ]);
        
        return redirect()->back()->with('message','Aseguradora Guardada con éxito', );
    }

     public function delete_asegu($id){
        
        DB::table('cat_aseguradoras')->delete($id);    

        return redirect()->back()->with('msjdelete','La Aseguradora fue Eliminado con éxito', );
    }

     public function update_asegu(Request $request,$id){
        
DB::table("cat_aseguradoras")->where('id',$id)->update([

            "Aseguradora"=>$request['nombre-asegu'],
            "Porcentaje"=>$request['porcentaje'],

        ]);

        return redirect()->back()->with('msjdelete','La aseguradoras fue Actualizado con éxito', );
    }

//especialidad
    public function VerEspecialidad(){
   $pacientes=DB::table("pacientes")->select("*")->get();
    $pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
    $areas=DB::table('cat_areas')->select('*')->get();
$especialidades=DB::table('cat_especialidades')->select('*')->get();
        return view("Catalogos.Especialidad",compact('especialidades','areas','pacientes_asignaciones','pacientes'));
    }

     public function save_espe(Request $request){
        $maxId = DB::table('cat_especialidades')->max('id');
    DB::statement('ALTER TABLE cat_especialidades AUTO_INCREMENT=' . intval($maxId + 1) . ';');
        DB::table("cat_especialidades")->insert([

            "Especialidad"=>$request['nombre-espe'],
            "Aforo"=>$request['Aforo'],

        ]);
        
        return redirect()->back()->with('message','Especialidad Guardada con éxito', );
    }

   public function delete_espe($id){

    $pacientes=DB::table("pacientes")->select("*")->get();
    $pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
    $pacientes_asignaciones=$pacientes_asignaciones->unique("id_paciente");
    
    foreach ($pacientes_asignaciones as $paciente_asi) {
        foreach ($pacientes as $paciente) {
            if ($paciente->id==$paciente_asi->id_paciente) {
                DB::table("pacientes")->where("id",$paciente->id)->update([
                    "id_estatus"=>1
                ]);
            }
        }
    }
        
        DB::table('cat_especialidades')->delete($id);    

        return redirect()->back()->with('msjdelete','La Especialidad fue Eliminada con éxito', );
    }

    public function update_espe(Request $request,$id){
        DB::table("cat_especialidades")->where('id',$id)->update([

            "Especialidad"=>$request['nombre-espe'],
            "Aforo"=>$request['aforo'],

        ]);
    return redirect()->back()->with('message','Especialidad Actualizada con éxito', );
    }

//procediminetos
    public function VerProcedimientos(){
$pacientes=DB::table("pacientes")->select("*")->get();
$pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
$areas=DB::table('cat_areas')->select('*')->get();
$especialidades=DB::table('cat_especialidades')->select('*')->get();
$procedimiento=DB::table('cat_procedimiento_costo')->select('*')->get();
        return view("Catalogos.Procedimientos",compact('procedimiento','especialidades','areas','pacientes_asignaciones','pacientes'));
    }

     public function save_proce(Request $request){
        $maxId = DB::table('cat_procedimiento_costo')->max('id');
    DB::statement('ALTER TABLE cat_procedimiento_costo AUTO_INCREMENT=' . intval($maxId + 1) . ';');
        DB::table("cat_procedimiento_costo")->insert([

            "Procedimiento"=>$request['procedimiento'],
            "Costo"=>$request['costo'],

        ]);
        
        return redirect()->back()->with('message','Procedimiento Guardado con éxito', );
    }

   public function delete_proce($id){
        
        DB::table('cat_procedimiento_costo')->delete($id);    

        return redirect()->back()->with('msjdelete','El Procedimiento fue Eliminada con éxito', );
    }

    public function update_proce(Request $request,$id){
        DB::table("cat_procedimiento_costo")->where('id',$id)->update([

            "Procedimiento"=>$request['procedimiento'],
            "Costo"=>$request['costo'],

        ]);
        
        return redirect()->back()->with('message','Procedimiento Actualizado con éxito', );
    }
}
