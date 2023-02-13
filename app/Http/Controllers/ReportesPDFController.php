<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
use PDF;

class Metodos extends Controller
{
    public function UnidadesTCFIU($tipo, $cli, $final, $inicio, $unidad)
    {
        /* ============================================================================== */
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                )->get();
                        }
                    }
                }
            }
        }
        /* ============================================================================== */
    }
    public function UnidadesCFIU($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->whereDate('seguro_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->whereDate('seguro_fecha', '>=', $inicio)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->whereDate('seguro_fecha', '>=', $inicio)
                            ->whereDate('seguro_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            }
        }
    }
    public function VeriUnidadesCFIU($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('verificacion_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('verificacion_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('verificacion_fecha', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->whereDate('verificacion_fecha', '>=', $inicio)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('verificacion_fecha', '>=', $inicio)
                        ->whereDate('verificacion_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('verificacion_fecha', '>=', $inicio)
                            ->whereDate('verificacion_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    }
                }
            }
        }
    }
    public function FumigacionesUnidadesCFIU($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->whereDate('lapsofumigacion', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->whereDate('lapsofumigacion', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->whereDate('lapsofumigacion', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->whereDate('lapsofumigacion', '>=', $inicio)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->whereDate('lapsofumigacion', '>=', $inicio)
                        ->whereDate('lapsofumigacion', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->whereDate('lapsofumigacion', '>=', $inicio)
                            ->whereDate('lapsofumigacion', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            }
        }
    }
    public function IndividualVTCFIU($tipo, $cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            }
        }
    }
}
class ReportesPDFController extends Metodos
{
    public function ReporteFlotillaPDF(Request $request)
    {
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::UnidadesTCFIU($tipo, $cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteFlotillas', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Flotillas',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Flotillas.pdf');
    }
    public function ReporteSegurosPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::UnidadesCFIU($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteSeguros', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Seguros',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Seguros.pdf');
    }
    public function ReporteVeriPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::VeriUnidadesCFIU($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteVeri', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Verificaciones',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Veri.pdf');
    }
    public function ReporteFumigacionesPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::FumigacionesUnidadesCFIU($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteFumigaciones', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Fumigaciones',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Fumigaciones.pdf');
    }
    public function ReporteIndividualVPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::IndividualVTCFIU($tipo, $cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteIndividualv', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Individual Vehicular',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'landscape');
        return $pdf->download('Reporte_Individual_Vehicular.pdf');
    }
}
