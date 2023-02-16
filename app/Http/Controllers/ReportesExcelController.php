<?php

namespace App\Http\Controllers;

use App\Exports\ReporteDiaExport;
use App\Models\Operadore;
use Illuminate\Http\Request;
use App\Models\Seguro;
use App\Models\Unidade;
use App\Models\Verificacione;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteFlotillasExport;
use App\Exports\ReporteFumigacionesExport;
use App\Exports\ReporteIndividualExport;
use App\Exports\ReporteIndividualVExport;
use App\Exports\ReporteSemanalExport;
use App\Exports\ReporteVeriExport;
use App\Exports\ReposteSegurosExport;
use App\Models\Fumigacione;

class ReportesExcelController extends Controller
{
    /* ============================================= EXCELES FUNCIONES ============================================= */
    public function reporte_flotillasexcel(Request $request)
    {
        /* return (new SegurosExport($unidad))->download('Seguros_unidad_' . $unidad . '.xlsx'); */
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            if ($tipo == 'Ambiental') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_Ambientales.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_F_Mecanicas.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_Ambas_Veri.xlsx');
            }
        } else {
            if ($tipo == 'Ambiental') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_Ambientales_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_F_Mecanicas_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_Ambas_Veri_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
        }
    }
    public function reporte_segurosexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            return (new ReposteSegurosExport($cli, $inicio, $final, $unidad))->download('Reporte_Seguros.xlsx');
        } else {
            return (new ReposteSegurosExport($cli, $inicio, $final, $unidad))->download('Reporte_Seguros_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_veriexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            return (new ReporteVeriExport($cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones.xlsx');
        } else {
            return (new ReporteVeriExport($cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_fumigacionesexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            return (new ReporteFumigacionesExport($cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones.xlsx');
        } else {
            return (new ReporteFumigacionesExport($cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_semanalexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteSemanalExport($cli, $inicio, $final))->download('Reporte_Semanal.xlsx');
        } else {
            return (new ReporteSemanalExport($cli, $inicio, $final))->download('Reporte_Semanal_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_diaexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Dia.xlsx');
        } else {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Dia_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_serviciosexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Servicios.xlsx');
        } else {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Servicios_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_individualexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $operador = "" . $request['filtrooper'];
        if ($cli == 'todos') {
            return (new ReporteIndividualExport($cli, $inicio, $final, $operador))->download('Reporte_individual.xlsx');
        } else {
            return (new ReporteIndividualExport($cli, $inicio, $final, $operador))->download('Reporte_individual_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reportes_individualvexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            if ($tipo == 'Ambiental') {
                return (new ReporteIndividualVExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_Ambientales.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteIndividualVExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_F_Mecanicas.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteIndividualVExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_Ambas_Veri.xlsx');
            }
        } else {
            if ($tipo == 'Ambiental') {
                return (new ReporteIndividualVExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_Ambientales_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteIndividualVExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_F_Mecanicas_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteIndividualVExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_Ambas_Veri_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
        }
    }
    /* ============================================================================================================= */
}
