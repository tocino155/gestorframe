<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class BusquedasController extends Controller
{
    public function __construct(){

        $this->middleware("auth");
    }
    
    public function buscar_cp($cp)
    {
         $result=\DB::table('cat_estados')->select('*')->where('cp',$cp)->get();

         return json_encode($result);
    }
    public function buscar_especialidad($id)
    {
         $result=DB::table('cat_areas')->where('Especialidad',$id)->get();
         return json_encode($result);
    }
    public function buscar_medico($id)
    {
         $result2=DB::table('medicos')->where('id_especialidad',$id)->get();
         return json_encode($result2);
    }
    public function buscar_procedimiento($id)
    {
         $result=DB::table('cat_procedimiento_costo')->where('id',$id)->get();
         return json_encode($result);
    }
     public function buscar_paciente($id)
     {
          $result=DB::table('pacientes')->where('id',$id)->get();
          return json_encode($result);
     }
     public function buscar_aseguradora($id)
     {
          $result=DB::table('cat_aseguradoras')->where('id',$id)->get();
          return json_encode($result);
     }
}
