<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AltaController;
use App\Http\Controllers\BusquedasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');
});

//busquedas
Route::get("/buscar_cp/{cp}",[BusquedasController::class,'buscar_cp']);
//Altas
Route::get('/alta', [AltaController::class,'vista_alta']);
Route::post("/guardar_pasiente",[AltaController::class,'guardar_pasiente']);
Route::delete("/eliminar_pasiente",[AltaController::class,'eliminar_pasiente']);