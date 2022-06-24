<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AltaController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\BusquedasController;
use App\Http\Controllers\CatalogosController;
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
    })->name('dash')->middleware("auth");






});


//busquedas
Route::get("/buscar_cp/{cp}",[BusquedasController::class,'buscar_cp']);
//Altas
Route::get('/alta', [AltaController::class,'vista_alta']);
Route::post("/guardar_pasiente",[AltaController::class,'guardar_pasiente']);
Route::delete("/eliminar_pasiente",[AltaController::class,'eliminar_pasiente']);

//consulta
Route::get('/consultas', [ConsultasController::class,'VerConsultas']);

//Facturacion
Route::get('/Facturaciones', [FacturacionController::class,'VerFactura']);

//catalogos
//area
Route::get('/Areas', [CatalogosController::class,'VerAreas']);
Route::post('/Guardar_area',[CatalogosController::class,'save_area']);
Route::delete('/Eliminar_area/{id}',[CatalogosController::class,'delete_area']);
Route::put('/Editar_area/{id}',[CatalogosController::class,'update_area']);



//aseguradora
Route::get('/Aseguradoras', [CatalogosController::class,'VerAseguradoras']);
Route::post('/Guardar_aseguradora',[CatalogosController::class,'save_asegu']);
Route::delete('/Eliminar_aseguradora/{id}',[CatalogosController::class,'delete_asegu']);
Route::put('/Editar_aseguradora/{id}',[CatalogosController::class,'update_asegu']);


//especialidad
Route::get('/Especialidad', [CatalogosController::class,'VerEspecialidad']);
Route::post('/Guardar_especialidad',[CatalogosController::class,'save_espe']);
Route::delete('/Eliminar_especialidad/{id}',[CatalogosController::class,'delete_espe']);
Route::put('/Editar_especialidad/{id}',[CatalogosController::class,'update_espe']);

//procediminetos
Route::get('/Procedimientos', [CatalogosController::class,'VerProcedimientos']);
Route::post('/Guardar_procedimiento',[CatalogosController::class,'save_proce']);
Route::delete('/Eliminar_procedimiento/{id}',[CatalogosController::class,'delete_proce']);
Route::put('/Editar_procedimiento/{id}',[CatalogosController::class,'update_proce']);