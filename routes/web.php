<?php

use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ExcelLogController;
use App\Http\Controllers\FoliosController;
use App\Http\Controllers\ObservadorController;
use App\Http\Controllers\OperadoresController;
use App\Http\Controllers\FumigadoresController;
use App\Http\Controllers\FumigacionesController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ReportesExcelController;
use App\Http\Controllers\VerificacionesController;
use App\Http\Controllers\Verificaciones2Controller;
use App\Http\Controllers\MantenimientosController;
use App\Models\Mantenimiento;

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

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* Route::get('/welcome',function(){return view('welcome');})->name('welcome'); */

Route::group(['middleware' =>['auth']],function(){
Route::resource('roles', RolController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('unidades', UnidadesController::class);
Route::resource('operadores', OperadoresController::class);
Route::resource('fumigadores', FumigadoresController::class);
Route::resource('fumigaciones', FumigacionesController::class);
Route::resource('seguros', SegurosController::class);
Route::resource('verificaciones', VerificacionesController::class);
Route::resource('verificacionesfisicomecanicas', Verificaciones2Controller::class);
Route::resource('mantenimientos', MantenimientosController::class);
Route::resource('logs', ObservadorController::class);
Route::resource('reportes', ReportesController::class);
Route::resource('tabla_reportes', ReportesController::class);
Route::resource('checklist', ChecklistController::class);
Route::resource('folios', FoliosController::class);
});
/* Route::controller(ExcelLogController::class)->group(function(){
    Route::get('log-export', 'export')->name('log.export');
    Route::post('log-import', 'import')->name('log.import');
}); */

///--------------------------------------UNIDADES--------------------------------------------------------------------
Route::get('/clientes/unidades/crear/{usuario}','App\Http\Controllers\UnidadesController@crear')->name('unidades.crear');

///--------------------------------------OPERADORES--------------------------------------------------------------------
Route::get('/clientes/unidades/operadores/crear/{usuario}','App\Http\Controllers\OperadoresController@crear')->name('operadores.crear');

///--------------------------------------CREAR VERIFICACIÓN--------------------------------------------------------------------
Route::get('/clientes/unidades/verificaciones/crear/{unidad}','App\Http\Controllers\VerificacionesController@crear')->name('verificaciones.crear');
///--------------------------------------CHECKLIST DATOS_UNIDADES--------------------------------------------------------------------
Route::post('/verificaciones/datos',function(){return view('verificaciones.datos');})->name('verificaciones.datos');
///--------------------------------------CREAR MANTENIMIENTO--------------------------------------------------------------------
Route::get('/clientes/unidades/mantenimientos/crear/{unidad}','App\Http\Controllers\MantenimientosController@crear')->name('mantenimientos.crear');
///--------------------------------------CREAR FUMIGACION--------------------------------------------------------------------
Route::get('/clientes/unidades/fumigaciones/crear/{unidad}','App\Http\Controllers\FumigacionesController@crear')->name('fumigaciones.crear');
///--------------------------------------CREAR VERIFICACIÓN--------------------------------------------------------------------
Route::get('/clientes/unidades/verificacionesfisicomecanicas/crear/{unidad}','App\Http\Controllers\Verificaciones2Controller@crear')->name('verificacionesfisicomecanicas.crear');

///--------------------------------------CREAR EXCEL LOG--------------------------------------------------------------------
Route::controller(ObservadorController::class)->group(function(){
    Route::get('logs-export', 'export')->name('logs.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL CLIENTES--------------------------------------------------------------------
Route::controller(ClientesController::class)->group(function(){
    Route::get('clientes-export', 'export')->name('clientes.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL FUMIGACIONES--------------------------------------------------------------------
Route::controller(FumigacionesController::class)->group(function(){
    Route::get('fumigaciones-export', 'export')->name('fumigaciones.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL FUMIGADORES--------------------------------------------------------------------
Route::controller(FumigadoresController::class)->group(function(){
    Route::get('fumigadores-export', 'export')->name('fumigadores.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL OPERADORES--------------------------------------------------------------------
Route::controller(OperadoresController::class)->group(function(){
    Route::get('operadores-export/{usuario}', 'export')->name('operadores.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL UNIDADES--------------------------------------------------------------------
Route::controller(UnidadesController::class)->group(function(){
    Route::get('unidades-export/{usuario}', 'export')->name('unidades.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL MANTENIMIENTOS--------------------------------------------------------------------
Route::controller(MantenimientosController::class)->group(function(){
    Route::get('mantenimientos-export/{unidad}', 'export')->name('mantenimientos.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL SEGUROS--------------------------------------------------------------------
Route::controller(SegurosController::class)->group(function(){
    Route::get('seguros-export/{unidad}', 'export')->name('seguros.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL VERIFICACIONES--------------------------------------------------------------------
Route::controller(VerificacionesController::class)->group(function(){
    Route::get('verificaciones-export/{unidad}', 'export')->name('verificaciones.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL VERIFICACIONES--------------------------------------------------------------------
Route::controller(VerificacionesController::class)->group(function(){
    Route::get('verificacionesfisicomecanicas-export/{unidad}', 'export')->name('verificacionesfisicomecanicas.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});

///--------------------------------------REPORTES SEGUROS--------------------------------------------------------------------
Route::get('/reportes/seguros/{color}', [App\Http\Controllers\ReportesController::class, 'seguros'])->name('reportes.seguros');
///--------------------------------------REPORTES VERIFICACIONES AMBIENTALES--------------------------------------------------------------------
Route::get('/reportes/verificaciones_ambientales/{color}', [App\Http\Controllers\ReportesController::class, 'vambiental'])->name('reportes.vambiental');
///--------------------------------------REPORTES VERIFICACIONES FISICO-MECANICAS--------------------------------------------------------------------
Route::get('/reportes/verificaciones_fisico_mecanicas/{color}', [App\Http\Controllers\ReportesController::class, 'vfisicas'])->name('reportes.vfisica');
///--------------------------------------REPORTES VERIFICACIONES MANTENIMIENTOS_K--------------------------------------------------------------------
Route::get('/reportes/mantenimientos_kilometraje/{color}', [App\Http\Controllers\ReportesController::class, 'mantenimientosk'])->name('reportes.mantenimientosk');
///--------------------------------------REPORTES VERIFICACIONES MANTENIMIENTOS--------------------------------------------------------------------
Route::get('/reportes/mantenimientos/{color}', [App\Http\Controllers\ReportesController::class, 'mantenimientos'])->name('reportes.mantenimientos');
///--------------------------------------REPORTES FUMIGACIONES--------------------------------------------------------------------
Route::get('/reportes/fumigaciones/{color}', [App\Http\Controllers\ReportesController::class, 'fumigaciones'])->name('reportes.fumigaciones');
///--------------------------------------REPORTES OPERADORES MEDICO--------------------------------------------------------------------
Route::get('/reportes/operadores/medico/{color}', [App\Http\Controllers\ReportesController::class, 'medico'])->name('reportes.medico');
///--------------------------------------REPORTES OPERADORES MEDICO--------------------------------------------------------------------
Route::get('/reportes/operadores/licencia/{color}', [App\Http\Controllers\ReportesController::class, 'licencia'])->name('reportes.licencia');






///--------------------------------------CHECKLIST ARRANQUE--------------------------------------------------------------------
Route::get('/arranque_unidad', [App\Http\Controllers\ChecklistController::class, 'arranque'])->name('checklist.arranque');

///--------------------------------------CHECKLIST ARRANQUE--------------------------------------------------------------------
Route::get('/arranque_unidad/guardar', [App\Http\Controllers\ChecklistController::class, 'guardarsalida'])->name('checklist.guardarsalida');


///--------------------------------------CHECKLIST REGRESO--------------------------------------------------------------------
Route::get('/regreso_unidad', [App\Http\Controllers\ChecklistController::class, 'regreso'])->name('checklist.regreso');

///--------------------------------------CHECKLIST REGRESO--------------------------------------------------------------------
Route::get('/regreso_unidad/guardar', [App\Http\Controllers\ChecklistController::class, 'guardarsalida'])->name('checklist.guardarsalida');


///--------------------------------------CHECKLIST DATOS_UNIDADES--------------------------------------------------------------------
Route::post('/datos_unidades',function(){return view('checklist.datos_unidades');})->name('checklist.datos_unidades');
///--------------------------------------CHECKLIST DATOS_OPERADORES--------------------------------------------------------------------
Route::post('/datos_operadores',function(){return view('checklist.datos_operadores');})->name('checklist.datos_operadores');
///--------------------------------------CHECKLIST UNIDADES--------------------------------------------------------------------
Route::post('/informacion_unidades',function(){return view('checklist.unidades');})->name('checklist.infounidades');
///--------------------------------------CHECKLIST UNIDADES--------------------------------------------------------------------
Route::post('/informacion_operadores',function(){return view('checklist.operadores');})->name('checklist.infooperadores');
/* -------------------------------------------------------- //BUG: REPORTES_Y_EXCELES -------------------------------------------------------- */
/// ================================================== REPORTE ==================================================
Route::get('/reportes_flotillas', [App\Http\Controllers\ReportesTablasController::class, 'reporte_flotilla'])->name('tabla_reportes.reporte_flotilla');
///EXCEL FLOTILLAS
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_flotillas/excel', 'reporte_flotillasexcel')->name('tabla_reportes.reporte_flotillasexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
Route::post('pdf/reportes_flotillas', [App\Http\Controllers\ReportesPDFController::class, 'ReporteFlotillaPDF'])->name('pdf.reporte_flotillaspdf');
Route::post('pdf/datos_unidades',function(){return view('pdf.datos_unidades');})->name('pdf.datos_unidades');
Route::post('pdf/datos_operadores',function(){return view('pdf.datos_operadores');})->name('pdf.datos_operadores');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_seguros', [App\Http\Controllers\ReportesTablasController::class, 'reporte_seguros'])->name('tabla_reportes.reporte_seguros');
///EXCEL SEGUROS
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_seguros/excel', 'reporte_segurosexcel')->name('tabla_reportes.reporte_segurosexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
Route::post('pdf/reportes_seguros', [App\Http\Controllers\ReportesPDFController::class, 'ReporteSegurosPDF'])->name('pdf.reporte_segurospdf');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_verificaciones', [App\Http\Controllers\ReportesTablasController::class, 'reporte_veri'])->name('tabla_reportes.reporte_veri');
///EXCEL SEGUROS
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_verificaciones/excel', 'reporte_veriexcel')->name('tabla_reportes.reporte_veriexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
Route::post('pdf/reportes_veri', [App\Http\Controllers\ReportesPDFController::class, 'ReporteVeriPDF'])->name('pdf.reporte_veripdf');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_preventivo', [App\Http\Controllers\ReportesTablasController::class, 'reporte_preventivo'])->name('tabla_reportes.reporte_preventivo');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_fumigaciones', [App\Http\Controllers\ReportesTablasController::class, 'reporte_fumigaciones'])->name('tabla_reportes.reporte_fumigaciones');
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_fumigaciones/excel', 'reporte_fumigacionesexcel')->name('tabla_reportes.reporte_fumigacionesexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
Route::post('pdf/reportes_fumigaciones', [App\Http\Controllers\ReportesPDFController::class, 'ReporteFumigacionesPDF'])->name('pdf.reporte_fumigacionespdf');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_operadores', [App\Http\Controllers\ReportesTablasController::class, 'reporte_operadores'])->name('tabla_reportes.reporte_operadores');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_semanal', [App\Http\Controllers\ReportesTablasController::class, 'reporte_semanal'])->name('tabla_reportes.reporte_semanal');
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_semanal/excel', 'reporte_semanalexcel')->name('tabla_reportes.reporte_semanalexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
/// ================================================== REPORTE ==================================================
Route::get('/reportes_dia', [App\Http\Controllers\ReportesTablasController::class, 'reporte_dia'])->name('tabla_reportes.reporte_dia');
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_dia/excel', 'reporte_diaexcel')->name('tabla_reportes.reporte_diaexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
/// ================================================== REPORTE ==================================================
Route::get('/reportes_servicios', [App\Http\Controllers\ReportesTablasController::class, 'reporte_servicios'])->name('tabla_reportes.reporte_servicios');
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_servicios/excel', 'reporte_serviciosexcel')->name('tabla_reportes.reporte_serviciosexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
/// ================================================== REPORTE ==================================================
Route::get('/reportes_individual', [App\Http\Controllers\ReportesTablasController::class, 'reporte_individual'])->name('tabla_reportes.reporte_individual');
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_individual/excel', 'reporte_individualexcel')->name('tabla_reportes.reporte_individualexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
Route::post('pdf/reportes_individual', [App\Http\Controllers\ReportesPDFController::class, 'ReporteIndividualPDF'])->name('pdf.reportes_individualpdf');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_individualv', [App\Http\Controllers\ReportesTablasController::class, 'reporte_individualv'])->name('tabla_reportes.reporte_individualv');
Route::controller(ReportesExcelController::class)->group(function(){
    Route::post('/reportes_individualv/excel', 'reportes_individualvexcel')->name('tabla_reportes.reportes_individualvexcel');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
Route::post('pdf/reportes_individualv', [App\Http\Controllers\ReportesPDFController::class, 'ReporteIndividualVPDF'])->name('pdf.reportes_individualvpdf');
/// ================================================== REPORTE ==================================================
Route::get('/reportes_satisfaccion', [App\Http\Controllers\ReportesTablasController::class, 'reporte_satisfaccion'])->name('tabla_reportes.reporte_satisfaccion');
/// ================================================== REPORTE ==================================================
///--------------------------------------CHECKLIST UNIDADES--------------------------------------------------------------------
Route::get('/reportes_bd', [App\Http\Controllers\ReportesController::class, 'reporte_bd'])->name('tabla_reportes.reporte_bd');











