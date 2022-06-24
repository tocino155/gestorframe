<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    //
public function __construct(){

        $this->middleware("auth");
        //$this->middleware("auth")->only("nombre_funcion","otro_motodo",....);
    }

    public function VerFactura(){

        return view("Facturacion.Facturacion");
    }

}
