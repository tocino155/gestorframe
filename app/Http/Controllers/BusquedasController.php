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
}
