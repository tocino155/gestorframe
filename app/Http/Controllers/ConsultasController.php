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

        return view("Consultas.Consulta");
    }


}
