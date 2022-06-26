<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use PDF;
class FacturacionController extends Controller
{
    //
public function __construct(){

        $this->middleware("auth");
        //$this->middleware("auth")->only("nombre_funcion","otro_motodo",....);
    }

    public function VerFactura(){
        $pacientes=DB::table("pacientes")->select("*")->get();
        $pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
        $medicos=DB::table("medicos")->select("*")->get();
        $especialidades=DB::table("cat_especialidades")->select("*")->get();
        $areas=DB::table("cat_areas")->select("*")->get();
        $paises=DB::table("paises")->select("*")->get();
        $aseguradoras=DB::table("cat_aseguradoras")->select("*")->get();
        $procedimientos=DB::table("cat_procedimiento_costo")->select("*")->get();
        return view("Facturacion.Facturacion",compact('pacientes','medicos','especialidades','areas','paises','pacientes_asignaciones','aseguradoras','procedimientos'));
    }
    public function asignar_aseguradora(Request $request){
        DB::table("pacientes")->where("id",$request['id_paciente'])->update([
            "id_aseguradora"=>$request['aseguradora'],
            "fecha_pago"=>$request['fecha_pago'],
            "observaciones_aseguradora"=>$request['observaciones']
        ]);
        return redirect()->back()->with(['message' => 'Aseguradora Agregada con éxito', 'color' => 'success']);
    }
    public function estatus_pago($id){
        DB::table('pacientes')->where("id",$id)->update([
            "id_estatus"=>3
        ]);
        return redirect()->back()->with(['message' => 'El Estatus Cambio a Pagado con éxito', 'color' => 'warning']);
    }

    public function generar_factura($id){
        $pacientes=DB::table("pacientes")->where("id",$id)->get();
        $pacientes_asignaciones=DB::table("pacientes_asignaciones")->where("id_paciente",$id)->get();
        $procedimientos=DB::table("cat_procedimiento_costo")->select("*")->get();
        $aseguradoras=DB::table("cat_aseguradoras")->select("*")->get();
        $pdf = PDF::loadView('Facturacion.formato_tiket',compact('pacientes','pacientes_asignaciones','procedimientos','aseguradoras'))->setPaper('a4', 'landscape');
        $nombre_completo=null;
        foreach ($pacientes as $paciente) {
            $nombre_completo=$paciente->nombre."_".$paciente->apellido_pat."_".$paciente->apellido_mat;
        }
        $nombre_pdf="Factura_Clinica_".$nombre_completo.".pdf";
        return $pdf->stream($nombre_pdf);
    }

}
