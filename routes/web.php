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

$pacientes=DB::table("pacientes")->select("*")->get();
$pacientes_asignaciones=DB::table("pacientes_asignaciones")->select("*")->get();
$especialidades=DB::table("cat_especialidades")->select("*")->get();
$areas=DB::table("cat_areas")->select("*")->get();

        return view('dash.index',compact('pacientes','pacientes_asignaciones','especialidades','areas'));
    })->name('dash')->middleware("auth");

});


//busquedas
Route::get("/buscar_cp/{cp}",[BusquedasController::class,'buscar_cp']);
Route::get("/buscar_especialidad/{id}",[BusquedasController::class,'buscar_especialidad']);
Route::get("/buscar_medico/{id}",[BusquedasController::class,'buscar_medico']);
Route::get("/buscar_procedimiento/{id}",[BusquedasController::class,'buscar_procedimiento']);
Route::get("/buscar_paciente/{id}",[BusquedasController::class,'buscar_paciente']);
Route::get("/buscar_aseguradora/{id}",[BusquedasController::class,'buscar_aseguradora']);

//Altas
Route::get('/alta', [AltaController::class,'vista_alta']);
Route::post("/guardar_pasiente",[AltaController::class,'guardar_paciente']);
Route::post("/actualizar_pasiente",[AltaController::class,'actualizar_paciente']);
Route::delete("/eliminar_pasiente",[AltaController::class,'eliminar_paciente']);
Route::delete("/eliminar_medico",[AltaController::class,'eliminar_medico']);
Route::post("/guardar_medico",[AltaController::class,'guardar_medico']);
Route::post("/actualizar_medico",[AltaController::class,'actualizar_medico']);

//consulta
Route::get('/consultas', [ConsultasController::class,'VerConsultas']);
Route::post('/guardar_asignacion', [ConsultasController::class,'guardar_asignacion']);
Route::get('/generar_historial/{id}', [ConsultasController::class,'generar_historial']);
Route::post("/dar_de_alta_paciente",[ConsultasController::class,'dar_de_alta_paciente']);
Route::post("/eliminar_paciente_s",[ConsultasController::class,'eliminar_paciente_s']);
Route::post("/guardar_horario_medico",[ConsultasController::class,'guardar_horario_medico']);

//Facturacion
Route::get('/Facturaciones', [FacturacionController::class,'VerFactura']);
Route::post('/asignar_aseguradora', [FacturacionController::class,'asignar_aseguradora']);
Route::post('/estatus_pago/{id}', [FacturacionController::class,'estatus_pago']);
Route::get('/generar_factura/{id}', [FacturacionController::class,'generar_factura']);

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