<?php

namespace App\Exports;

use App\Models\Unidade;
use App\Models\Fumigacione;
use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteSatisfaccionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final, string $unidad, string $tipou)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->unidad = $unidad;
        $this->tipou = $tipou;
    }
    public function collection()
    {
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $unidad = $this->unidad;
        $tipou = $this->tipou;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                }
            }
        } else {
            if ($cli == 'todos') {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                }
            } else {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "FOLIO FUMIGACION",
            "CLIENTE", "UNIDAD", "FECHA ULTIMA FUMIGACION", "FUMIGADOR", "RAZON SOCIAL CLIENTE", "DIRECCION FISICA CLIENTE",
            "STATUS"
        ];
    }
}
