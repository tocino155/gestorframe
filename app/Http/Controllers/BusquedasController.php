<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusquedasController extends Controller
{
    public function buscar_cp($cp)
    {
         $result=\DB::table('cat_estados')->select('*')->where('cp',$cp)->get();

         return json_encode($result);
    }
}
