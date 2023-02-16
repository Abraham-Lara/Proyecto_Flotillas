@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Unidades de {{ $usuario }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.index') }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('general-rol')
                                <a class="btn btn-warning" href="{{ route('unidades.crear', $usuario) }}">Nuevo</a>
                            @endcan
                            <table id='tablas-style' class="table table-striped mt-2">
                                <a class="btn btn-md" style="background-color: #7caa98"
                                    href="{{ route('unidades.export', $usuario) }}"><i class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <br>
                                <br>
                                <thead style="background-color:#95b8f6">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Placas/<br>Dirección</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Estado Seguro</th>
                                    <th style="color:#fff;">Verificación Ambiental</th>
                                    <th style="color:#fff;">Verificación Físico-Mecánica</th>
                                    <th style="color:#fff;">Estado Mantenimiento</th>
                                    <th style="color:#fff;">Estado Fumigación</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td style="display: none;">{{ $unidade->id }}</td>
                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                <td>{{ $unidade->direccion }}</td>
                                            @endif
                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                <td>{{ $unidade->placas }}</td>
                                            @endif
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-sm text-dark"
                                                    style="background-color: #9dbad5"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ================================ //BUG:SEGUROS ================================ --}}
                                            <td>
                                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                    <span class="badge badge-dark">
                                                        No aplica
                                                    </span>
                                                @endif
                                                @if ($unidade->tipo == 'Unidad Vehicular')
                                                    @if ($unidade->seguro == 'Sin Seguro')
                                                        <h6><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Sin
                                                                Seguro</a></span></h6>
                                                    @else
                                                        {{-- ===================== CALCULO_DE_FECHAS_SEGURO ===================== --}}
                                                        @php
                                                            /* FECHA LICENCIA */
                                                            $vencimiento_dia = substr($unidade->seguro_fecha, 8, 2);
                                                            $vencimiento_mes = substr($unidade->seguro_fecha, 5, 2);
                                                            $vencimiento_año = substr($unidade->seguro_fecha, 0, 4);
                                                            /* FECHA ACTUAL */
                                                            $año_actual = date('Y');
                                                            $mes_actual = date('n');
                                                            $dia_actual = date('d');
                                                            /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                                                            $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                                                            /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                                                            $uno = 'nulo';
                                                            $calcular = 0;
                                                            $mes_contador = 1;
                                                            $dias_exactos = 1;
                                                            //cambio
                                                            if ($diferencia_año >= 1) {
                                                                $meses = $diferencia_año * 12 + 12;
                                                                $operacion_1 = $meses - (int) $mes_actual;
                                                                $operacion_2 = 12 - (int) $vencimiento_mes;
                                                                $operacion_3 = $operacion_1 - $operacion_2;
                                                                $meses = $operacion_3;
                                                            } else {
                                                                if ($diferencia_año == 0) {
                                                                    $meses = (int) $vencimiento_mes - (int) $mes_actual;
                                                                } else {
                                                                    $mes_contador = 0;
                                                                    $dias_exactos = 0;
                                                                }
                                                            }
                                                            if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                                                $uno = 'uno';
                                                                $calcular = 0;
                                                            } else {
                                                                $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                                                $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                                                $calcular = $direstantes + (int) $vencimiento_dia;
                                                            }
                                                            /* CALCULO DE DIAS EXACTOS */
                                                            $contador_1 = 0;
                                                            $contador_2 = 0;
                                                            $cuenta_mes = $mes_actual;
                                                            $operacion_1 = 0;
                                                            if ($mes_contador == 1 && $dias_exactos == 1) {
                                                                $mes_contador = 0;
                                                                $dias_exactos = 0;
                                                                for ($i = 0; $i <= $meses; $i++) {
                                                                    if ($uno == 'uno') {
                                                                        $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                                                        $i = $meses + 1;
                                                                    } else {
                                                                        if ($contador_1 == 0) {
                                                                            $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                            $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                                                            $dias_exactos = $dias_exactos + $operacion_2;
                                                                            $contador_1 = 1;
                                                                        } else {
                                                                            if ($i == $meses) {
                                                                                $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                                                            } else {
                                                                                $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                                $dias_exactos = $dias_exactos + (int) $operacion_1;
                                                                                $mes_contador = $mes_contador + 1;
                                                                            }
                                                                        }
                                                                        if ($cuenta_mes == 12) {
                                                                            $contador_2 = $contador_2 + 1;
                                                                            $cuenta_mes = 1;
                                                                        } else {
                                                                            $cuenta_mes = $cuenta_mes + 1;
                                                                        }
                                                                    }
                                                                }
                                                                /* CALCULO DE MESES EXACTOS */
                                                            
                                                                $dias_resto = $calcular;
                                                                $opc = 2;
                                                                for ($i = 0; $i <= $opc; $i++) {
                                                                    if ($calcular >= 30) {
                                                                        $mes_contador = $mes_contador + 1;
                                                                        $calcular = $calcular - 30;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        {{-- ============================================================== --}}
                                                        {{-- ========================== IF PARA MOSTRAR =================== --}}
                                                        <h6>
                                                            @if ($mes_contador >= 9)
                                                                <span class="badge badge-primary">
                                                                    <a class="link-light"
                                                                        href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                                <span class="badge badge-success">
                                                                    <a class="link-light"
                                                                        href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                                <span class="badge badge-warning">
                                                                    <a class="link-light"
                                                                        href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'nulo')
                                                                @if ($calcular == 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en:<br>
                                                                            {{ $mes_contador }} mes
                                                                        </a> </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en:<br>
                                                                            {{ $mes_contador }} mes
                                                                            <br>y {{ $calcular }} dias
                                                                        </a> </span>
                                                                @endif
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'uno')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos > 0)
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">
                                                                        Seguro
                                                                        <br> Expirado
                                                                    </a> </span>
                                                            @endif
                                                        </h6>
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- ================================ //BUG: V.AMBIENTAL ================================ --}}
                                            <td>
                                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                    <span class="badge badge-dark">
                                                        No aplica
                                                    </span>
                                                @endif
                                                @if ($unidade->tipo == 'Unidad Vehicular')
                                                    @if ($unidade->verificacion == 'Sin Verificación')
                                                        <h6><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Sin
                                                                verificación</a></span></h6>
                                                    @else
                                                        {{-- ===================== CALCULO_DE_FECHAS_VERIFICACIONES ===================== --}}
                                                        @php
                                                            /* FECHA LICENCIA */
                                                            $vencimiento_dia = substr($unidade->verificacion_fecha, 8, 2);
                                                            $vencimiento_mes = substr($unidade->verificacion_fecha, 5, 2);
                                                            $vencimiento_año = substr($unidade->verificacion_fecha, 0, 4);
                                                            /* FECHA ACTUAL */
                                                            $año_actual = date('Y');
                                                            $mes_actual = date('n');
                                                            $dia_actual = date('d');
                                                            /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                                                            $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                                                            /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                                                            $uno = 'nulo';
                                                            $calcular = 0;
                                                            $mes_contador = 1;
                                                            $dias_exactos = 1;
                                                            //cambio
                                                            if ($diferencia_año >= 1) {
                                                                $meses = $diferencia_año * 12 + 12;
                                                                $operacion_1 = $meses - (int) $mes_actual;
                                                                $operacion_2 = 12 - (int) $vencimiento_mes;
                                                                $operacion_3 = $operacion_1 - $operacion_2;
                                                                $meses = $operacion_3;
                                                            } else {
                                                                if ($diferencia_año == 0) {
                                                                    $meses = (int) $vencimiento_mes - (int) $mes_actual;
                                                                } else {
                                                                    $mes_contador = 0;
                                                                    $dias_exactos = 0;
                                                                }
                                                            }
                                                            if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                                                $uno = 'uno';
                                                                $calcular = 0;
                                                            } else {
                                                                $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                                                $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                                                $calcular = $direstantes + (int) $vencimiento_dia;
                                                            }
                                                            /* CALCULO DE DIAS EXACTOS */
                                                            $contador_1 = 0;
                                                            $contador_2 = 0;
                                                            $cuenta_mes = $mes_actual;
                                                            $operacion_1 = 0;
                                                            if ($mes_contador == 1 && $dias_exactos == 1) {
                                                                $mes_contador = 0;
                                                                $dias_exactos = 0;
                                                                for ($i = 0; $i <= $meses; $i++) {
                                                                    if ($uno == 'uno') {
                                                                        $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                                                        $i = $meses + 1;
                                                                    } else {
                                                                        if ($contador_1 == 0) {
                                                                            $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                            $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                                                            $dias_exactos = $dias_exactos + $operacion_2;
                                                                            $contador_1 = 1;
                                                                        } else {
                                                                            if ($i == $meses) {
                                                                                $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                                                            } else {
                                                                                $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                                $dias_exactos = $dias_exactos + (int) $operacion_1;
                                                                                $mes_contador = $mes_contador + 1;
                                                                            }
                                                                        }
                                                                        if ($cuenta_mes == 12) {
                                                                            $contador_2 = $contador_2 + 1;
                                                                            $cuenta_mes = 1;
                                                                        } else {
                                                                            $cuenta_mes = $cuenta_mes + 1;
                                                                        }
                                                                    }
                                                                }
                                                                /* CALCULO DE MESES EXACTOS */
                                                            
                                                                $dias_resto = $calcular;
                                                                $opc = 2;
                                                                for ($i = 0; $i <= $opc; $i++) {
                                                                    if ($calcular >= 30) {
                                                                        $mes_contador = $mes_contador + 1;
                                                                        $calcular = $calcular - 30;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        {{-- ============================================================== --}}
                                                        {{-- ========================== IF PARA MOSTRAR =================== --}}
                                                        <h6>
                                                            @if ($mes_contador >= 9)
                                                                <span class="badge badge-primary">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                                <span class="badge badge-success">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                                <span class="badge badge-warning">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'nulo')
                                                                @if ($calcular == 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en:<br>
                                                                            {{ $mes_contador }} mes
                                                                        </a> </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en:<br>
                                                                            {{ $mes_contador }} mes
                                                                            <br>y {{ $calcular }} dias
                                                                        </a> </span>
                                                                @endif
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'uno')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos > 0)
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">
                                                                        Verificación
                                                                        <br> Expirada
                                                                    </a> </span>
                                                            @endif
                                                        </h6>
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- ================================ //BUG: V.FISICA ================================ --}}
                                            <td>
                                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                    <span class="badge badge-dark">
                                                        No aplica
                                                    </span>
                                                @endif
                                                @if ($unidade->tipo == 'Unidad Vehicular')
                                                    @if ($unidade->verificacion2 == 'Sin Verificación')
                                                        <h6><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Sin
                                                                verificación</a></span></h6>
                                                    @else
                                                        {{-- ===================== CALCULO_DE_FECHAS_VERIFICACIONES ===================== --}}
                                                        @php
                                                            /* FECHA LICENCIA */
                                                            $vencimiento_dia = substr($unidade->verificacion_fecha2, 8, 2);
                                                            $vencimiento_mes = substr($unidade->verificacion_fecha2, 5, 2);
                                                            $vencimiento_año = substr($unidade->verificacion_fecha2, 0, 4);
                                                            /* FECHA ACTUAL */
                                                            $año_actual = date('Y');
                                                            $mes_actual = date('n');
                                                            $dia_actual = date('d');
                                                            /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                                                            $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                                                            /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                                                            $uno = 'nulo';
                                                            $calcular = 0;
                                                            $mes_contador = 1;
                                                            $dias_exactos = 1;
                                                            //cambio
                                                            if ($diferencia_año >= 1) {
                                                                $meses = $diferencia_año * 12 + 12;
                                                                $operacion_1 = $meses - (int) $mes_actual;
                                                                $operacion_2 = 12 - (int) $vencimiento_mes;
                                                                $operacion_3 = $operacion_1 - $operacion_2;
                                                                $meses = $operacion_3;
                                                            } else {
                                                                if ($diferencia_año == 0) {
                                                                    $meses = (int) $vencimiento_mes - (int) $mes_actual;
                                                                } else {
                                                                    $mes_contador = 0;
                                                                    $dias_exactos = 0;
                                                                }
                                                            }
                                                            if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                                                $uno = 'uno';
                                                                $calcular = 0;
                                                            } else {
                                                                $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                                                $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                                                $calcular = $direstantes + (int) $vencimiento_dia;
                                                            }
                                                            /* CALCULO DE DIAS EXACTOS */
                                                            $contador_1 = 0;
                                                            $contador_2 = 0;
                                                            $cuenta_mes = $mes_actual;
                                                            $operacion_1 = 0;
                                                            if ($mes_contador == 1 && $dias_exactos == 1) {
                                                                $mes_contador = 0;
                                                                $dias_exactos = 0;
                                                                for ($i = 0; $i <= $meses; $i++) {
                                                                    if ($uno == 'uno') {
                                                                        $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                                                        $i = $meses + 1;
                                                                    } else {
                                                                        if ($contador_1 == 0) {
                                                                            $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                            $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                                                            $dias_exactos = $dias_exactos + $operacion_2;
                                                                            $contador_1 = 1;
                                                                        } else {
                                                                            if ($i == $meses) {
                                                                                $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                                                            } else {
                                                                                $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                                $dias_exactos = $dias_exactos + (int) $operacion_1;
                                                                                $mes_contador = $mes_contador + 1;
                                                                            }
                                                                        }
                                                                        if ($cuenta_mes == 12) {
                                                                            $contador_2 = $contador_2 + 1;
                                                                            $cuenta_mes = 1;
                                                                        } else {
                                                                            $cuenta_mes = $cuenta_mes + 1;
                                                                        }
                                                                    }
                                                                }
                                                                /* CALCULO DE MESES EXACTOS */
                                                            
                                                                $dias_resto = $calcular;
                                                                $opc = 2;
                                                                for ($i = 0; $i <= $opc; $i++) {
                                                                    if ($calcular >= 30) {
                                                                        $mes_contador = $mes_contador + 1;
                                                                        $calcular = $calcular - 30;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        {{-- ============================================================== --}}
                                                        {{-- ========================== IF PARA MOSTRAR =================== --}}
                                                        <h6>
                                                            @if ($mes_contador >= 9)
                                                                <span class="badge badge-primary">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                                <span class="badge badge-success">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                                <span class="badge badge-warning">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'nulo')
                                                                @if ($calcular == 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en:<br>
                                                                            {{ $mes_contador }} mes
                                                                        </a> </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en:<br>
                                                                            {{ $mes_contador }} mes
                                                                            <br>y {{ $calcular }} dias
                                                                        </a> </span>
                                                                @endif
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'uno')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos > 0)
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:<br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('verificacionesfisicomecanicas.show', $unidad = $unidade->serieunidad) }}">
                                                                        Verificación
                                                                        <br> Expirada
                                                                    </a> </span>
                                                            @endif
                                                        </h6>
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- ================================ //BUG:MANTENIMIENTO ================================ --}}
                                            <td>
                                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                    <span class="badge badge-dark">
                                                        No aplica
                                                    </span>
                                                @endif
                                                @if ($unidade->tipo == 'Unidad Vehicular')
                                                    @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                                        <h6><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Sin
                                                                mantenimiento</a></span></h6>
                                                    @else
                                                        @if ($unidade->tipomantenimiento == 'Fecha')
                                                            {{-- ===================== CALCULO_DE_FECHAS_MANTENIMIENTO ===================== --}}
                                                            @php
                                                                /* FECHA LICENCIA */
                                                                $vencimiento_dia = substr($unidade->mantenimiento_fecha, 8, 2);
                                                                $vencimiento_mes = substr($unidade->mantenimiento_fecha, 5, 2);
                                                                $vencimiento_año = substr($unidade->mantenimiento_fecha, 0, 4);
                                                                $vencimiento_mes = $vencimiento_mes + $unidade->frecuencia_mante;
                                                                if ($vencimiento_mes > 12) {
                                                                    $vencimiento_año = $vencimiento_año + 1;
                                                                    $vencimiento_mes = $vencimiento_mes - 12;
                                                                }
                                                                /* FECHA ACTUAL */
                                                                $año_actual = date('Y');
                                                                $mes_actual = date('n');
                                                                $dia_actual = date('d');
                                                                /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                                                                $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                                                                /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                                                                $uno = 'nulo';
                                                                $calcular = 0;
                                                                $mes_contador = 1;
                                                                $dias_exactos = 1;
                                                                //cambio
                                                                if ($diferencia_año >= 1) {
                                                                    $meses = $diferencia_año * 12 + 12;
                                                                    $operacion_1 = $meses - (int) $mes_actual;
                                                                    $operacion_2 = 12 - (int) $vencimiento_mes;
                                                                    $operacion_3 = $operacion_1 - $operacion_2;
                                                                    $meses = $operacion_3;
                                                                } else {
                                                                    if ($diferencia_año == 0) {
                                                                        $meses = (int) $vencimiento_mes - (int) $mes_actual;
                                                                    } else {
                                                                        $mes_contador = 0;
                                                                        $dias_exactos = 0;
                                                                    }
                                                                }
                                                                if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                                                    $uno = 'uno';
                                                                    $calcular = 0;
                                                                } else {
                                                                    $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                                                    $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                                                    $calcular = $direstantes + (int) $vencimiento_dia;
                                                                }
                                                                /* CALCULO DE DIAS EXACTOS */
                                                                $contador_1 = 0;
                                                                $contador_2 = 0;
                                                                $cuenta_mes = $mes_actual;
                                                                $operacion_1 = 0;
                                                                if ($mes_contador == 1 && $dias_exactos == 1) {
                                                                    $mes_contador = 0;
                                                                    $dias_exactos = 0;
                                                                    for ($i = 0; $i <= $meses; $i++) {
                                                                        if ($uno == 'uno') {
                                                                            $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                                                            $i = $meses + 1;
                                                                        } else {
                                                                            if ($contador_1 == 0) {
                                                                                $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                                $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                                                                $dias_exactos = $dias_exactos + $operacion_2;
                                                                                $contador_1 = 1;
                                                                            } else {
                                                                                if ($i == $meses) {
                                                                                    $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                                                                } else {
                                                                                    $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                                    $dias_exactos = $dias_exactos + (int) $operacion_1;
                                                                                    $mes_contador = $mes_contador + 1;
                                                                                }
                                                                            }
                                                                            if ($cuenta_mes == 12) {
                                                                                $contador_2 = $contador_2 + 1;
                                                                                $cuenta_mes = 1;
                                                                            } else {
                                                                                $cuenta_mes = $cuenta_mes + 1;
                                                                            }
                                                                        }
                                                                    }
                                                                    /* CALCULO DE MESES EXACTOS */
                                                                
                                                                    $dias_resto = $calcular;
                                                                    $opc = 2;
                                                                    for ($i = 0; $i <= $opc; $i++) {
                                                                        if ($calcular >= 30) {
                                                                            $mes_contador = $mes_contador + 1;
                                                                            $calcular = $calcular - 30;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            {{-- ============================================================== --}}
                                                            {{-- ========================== IF PARA MOSTRAR_POR FECHAS =================== --}}
                                                            <h6>
                                                                @if ($mes_contador >= 9)
                                                                    <span class="badge badge-primary">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} meses</a>
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                                    <span class="badge badge-success">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} meses</a>
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                                    <span class="badge badge-warning">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} meses</a>
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador == 1 && $uno == 'nulo')
                                                                    @if ($calcular == 0)
                                                                        <span class="badge badge-danger">
                                                                            <a class="link-light"
                                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                                en: <br>
                                                                                {{ $mes_contador }} mes
                                                                            </a> </span>
                                                                    @else
                                                                        <span class="badge badge-danger">
                                                                            <a class="link-light"
                                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                                en: <br>
                                                                                {{ $mes_contador }} mes <br> y
                                                                                {{ $calcular }} dias
                                                                            </a> </span>
                                                                    @endif
                                                                @endif
                                                                @if ($mes_contador == 1 && $uno == 'uno')
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $dias_exactos }} dias
                                                                        </a> </span>
                                                                @endif
                                                                @if ($mes_contador == 0 && $dias_exactos > 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $dias_exactos }} dias
                                                                        </a> </span>
                                                                @endif
                                                                @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">
                                                                            Mantenimiento
                                                                            <br> Expirado
                                                                        </a> </span>
                                                                @endif
                                                            </h6>
                                                        @endif
                                                        {{-- ============================================================== --}}
                                                        {{-- ========================== IF PARA MOSTRAR_POR KILOMETRAJE =================== --}}
                                                        <h6>
                                                            @if ($unidade->tipomantenimiento == 'Kilometraje')
                                                                @php
                                                                    $km_contador = $unidade->kilometros_contador;
                                                                    $frecuencia = $unidade->frecuencia_mante;
                                                                    $km_actual = $unidade->kilometros_actuales;
                                                                    $diferencia = $frecuencia + $km_actual - $km_contador;
                                                                @endphp
                                                                @if ($km_contador >= $frecuencia + $km_actual)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">
                                                                            Mantenimiento
                                                                            <br> Expirado
                                                                        </a> </span>
                                                                @endif
                                                                @if ($km_contador < $frecuencia + $km_actual)
                                                                    @php
                                                                        $diferencia = $frecuencia + $km_actual - $km_contador;
                                                                    @endphp
                                                                    @if ($diferencia >= 1 && $diferencia < 100)
                                                                        <span class="badge badge-danger">
                                                                            <a class="link-light"
                                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">
                                                                                {{ $diferencia }} Km
                                                                                <br> Para expirar
                                                                            </a> </span>
                                                                    @endif
                                                                    @if ($diferencia >= 100 && $diferencia < 300)
                                                                        <span class="badge badge-warning">
                                                                            <a class="link-light"
                                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">
                                                                                {{ $diferencia }} Km
                                                                                <br> Para expirar
                                                                            </a> </span>
                                                                    @endif
                                                                    @if ($diferencia >= 300 && $diferencia < 500)
                                                                        <span class="badge badge-success">
                                                                            <a class="link-light"
                                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">
                                                                                {{ $diferencia }} Km
                                                                                <br> Para expirar
                                                                            </a> </span>
                                                                    @endif
                                                                    @if ($diferencia >= 500)
                                                                        <span class="badge badge-primary">
                                                                            <a class="link-light"
                                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">
                                                                                {{ $diferencia }} Km
                                                                                <br> Para expirar
                                                                            </a> </span>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </h6>
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- ================================ //BUG:FUMIGACIÓN ================================ --}}
                                            <td>
                                                @if ($unidade->fumigacion == 'Sin Fumigación')
                                                    @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                        <h6><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Sin
                                                                fumigación</a></span></h6>
                                                    @endif
                                                    @if ($unidade->tipo == 'Unidad Vehicular')
                                                       <h6> <span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Sin
                                                                fumigación
                                                            </a></h6>
                                                        </span>
                                                    @endif
                                                @else
                                                    {{-- ===================== CALCULO_DE_FECHAS_FUMIGACION ===================== --}}
                                                    @php
                                                        /* FECHA LICENCIA */
                                                        $vencimiento_dia = substr($unidade->lapsofumigacion, 8, 2);
                                                        $vencimiento_mes = substr($unidade->lapsofumigacion, 5, 2);
                                                        $vencimiento_año = substr($unidade->lapsofumigacion, 0, 4);
                                                        $vencimiento_mes = $vencimiento_mes + $unidade->frecuencia_fumiga;
                                                        if ($vencimiento_mes > 12) {
                                                            $vencimiento_año = $vencimiento_año + 1;
                                                            $vencimiento_mes = $vencimiento_mes - 12;
                                                        }
                                                        /* FECHA ACTUAL */
                                                        $año_actual = date('Y');
                                                        $mes_actual = date('n');
                                                        $dia_actual = date('d');
                                                        /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                                                        $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                                                        /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                                                        $uno = 'nulo';
                                                        $calcular = 0;
                                                        $mes_contador = 1;
                                                        $dias_exactos = 1;
                                                        //cambio
                                                        if ($diferencia_año >= 1) {
                                                            $meses = $diferencia_año * 12 + 12;
                                                            $operacion_1 = $meses - (int) $mes_actual;
                                                            $operacion_2 = 12 - (int) $vencimiento_mes;
                                                            $operacion_3 = $operacion_1 - $operacion_2;
                                                            $meses = $operacion_3;
                                                        } else {
                                                            if ($diferencia_año == 0) {
                                                                $meses = (int) $vencimiento_mes - (int) $mes_actual;
                                                            } else {
                                                                $mes_contador = 0;
                                                                $dias_exactos = 0;
                                                            }
                                                        }
                                                        if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                                            $uno = 'uno';
                                                            $calcular = 0;
                                                        } else {
                                                            $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                                            $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                                            $calcular = $direstantes + (int) $vencimiento_dia;
                                                        }
                                                        /* CALCULO DE DIAS EXACTOS */
                                                        $contador_1 = 0;
                                                        $contador_2 = 0;
                                                        $cuenta_mes = $mes_actual;
                                                        $operacion_1 = 0;
                                                        if ($mes_contador == 1 && $dias_exactos == 1) {
                                                            $mes_contador = 0;
                                                            $dias_exactos = 0;
                                                            for ($i = 0; $i <= $meses; $i++) {
                                                                if ($uno == 'uno') {
                                                                    $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                                                    $i = $meses + 1;
                                                                } else {
                                                                    if ($contador_1 == 0) {
                                                                        $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                        $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                                                        $dias_exactos = $dias_exactos + $operacion_2;
                                                                        $contador_1 = 1;
                                                                    } else {
                                                                        if ($i == $meses) {
                                                                            $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                                                        } else {
                                                                            $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                                                            $dias_exactos = $dias_exactos + (int) $operacion_1;
                                                                            $mes_contador = $mes_contador + 1;
                                                                        }
                                                                    }
                                                                    if ($cuenta_mes == 12) {
                                                                        $contador_2 = $contador_2 + 1;
                                                                        $cuenta_mes = 1;
                                                                    } else {
                                                                        $cuenta_mes = $cuenta_mes + 1;
                                                                    }
                                                                }
                                                            }
                                                            /* CALCULO DE MESES EXACTOS */
                                                        
                                                            $dias_resto = $calcular;
                                                            $opc = 2;
                                                            for ($i = 0; $i <= $opc; $i++) {
                                                                if ($calcular >= 30) {
                                                                    $mes_contador = $mes_contador + 1;
                                                                    $calcular = $calcular - 30;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    {{-- ============================================================== --}}
                                                    {{-- ========================== IF PARA MOSTRAR =================== --}}
                                                    <h6>
                                                        @if ($mes_contador >= 9)
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <span class="badge badge-primary">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                        en: <br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <span class="badge badge-primary">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en: <br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                        @endif
                                                        @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <span class="badge badge-success">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                        en: <br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <span class="badge badge-success">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en: <br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                        @endif
                                                        @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <span class="badge badge-warning">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                        en: <br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <span class="badge badge-warning">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en: <br>
                                                                        {{ $mes_contador }} meses</a>
                                                                </span>
                                                            @endif
                                                        @endif
                                                        @if ($mes_contador == 1 && $uno == 'nulo')
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                @if ($calcular == 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} mes
                                                                        </a> </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} mes <br>
                                                                            <br> y {{ $calcular }} dias
                                                                        </a> </span>
                                                                @endif
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                @if ($calcular == 0)
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} mes
                                                                        </a> </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        <a class="link-light"
                                                                            href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                            en: <br>
                                                                            {{ $mes_contador }} mes <br>
                                                                            <br> y {{ $calcular }} dias
                                                                        </a> </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                        @if ($mes_contador == 1 && $uno == 'uno')
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                        en: <br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en: <br>
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                        @endif
                                                        @if ($mes_contador == 0 && $dias_exactos > 0)
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">Expira
                                                                        en:
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                        en:
                                                                        {{ $dias_exactos }} dias
                                                                    </a> </span>
                                                            @endif
                                                        @endif
                                                        @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->direccion) }}">
                                                                        Fumigación expirada

                                                                    </a> </span>
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <span class="badge badge-danger">
                                                                    <a class="link-light"
                                                                        href="{{ route('fumigaciones.show', $unidad = $unidade->serieunidad) }}">
                                                                        Fumigación expirada

                                                                    </a> </span>
                                                            @endif
                                                        @endif
                                                    </h6>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm" style="background-color: #9dbad5"
                                                    href="{{ route('unidades.edit', $unidade->id) }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-sm"
                                                    style="background-color: #ff8097"
                                                    onclick="$('#delete{{ $a }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                            $a = $a . 'a';
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{--  <div class="pagination justify-content-end">
                                {!! $unidades->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @php
        $a = 'a';
    @endphp
    @foreach ($unidades as $unidade)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                    {{ $unidade->direccion }}
                                @endif
                                @if ($unidade->tipo == 'Unidad Vehicular')
                                    {{ $unidade->placas }}
                                @endif
                            </b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        @if ($unidade->tipo == 'Unidad Vehicular')
                            <b>Cliente:</b>
                            <li class="list-group-item">
                                {{ $unidade->cliente }}
                            </li>
                            <br>
                            <b>No. Economico:</b>
                            <li class="list-group-item">
                                {{ $unidade->economico }}
                            </li>
                            <br>
                            <b>Digito Placa:</b>
                            <li class="list-group-item">
                                {{ $unidade->digitoplaca }}
                            </li>
                            <br>
                            <b>Marca:</b>
                            <li class="list-group-item">
                                {{ $unidade->marca }}
                            </li>
                            <br>
                            <b>SubMarca:</b>
                            <li class="list-group-item">
                                {{ $unidade->submarca }}
                            </li>
                            <br>
                            <b>Año de la Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->añounidad }}
                            </li>
                            <br>
                            <b>Kilometraje:</b>
                            <li class="list-group-item">
                                {{ $unidade->kilometros_contador }}
                            </li>
                            <br>
                            <b>Tipo de Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->tipounidad }}
                            </li>
                            <br>
                            <b>Razon Social:</b>
                            <li class="list-group-item">
                                {{ $unidade->razonsocialunidad }}
                            </li>
                            <br>
                            <b>Serie de la unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->serieunidad }}
                            </li>
                            <br>
                            <b>Vencimiento Seguro:</b>
                            <li class="list-group-item">
                                {{ $unidade->seguro_fecha }}
                            </li>
                            <br>
                            <b>Vencimiento Verificación:</b>
                            <li class="list-group-item">
                                {{ $unidade->verificacion_fecha }}
                            </li>
                            <br>
                            @if ($unidade->tipomantenimiento == 'Fecha')
                                <b>Tipo de Mantenimiento:</b>
                                <li class="list-group-item">
                                    Mantenimiento por Fecha de Vencimiento
                                </li>
                                <br>
                            @endif
                            @if ($unidade->tipomantenimiento == 'Kilometraje')
                                <b>Tipo de Mantenimiento:</b>
                                <li class="list-group-item">
                                    Mantenimiento por Kilometraje
                                </li>
                                <br>
                            @endif
                            <b>Vencimiento Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->lapsofumigacion }}
                            </li>
                            <br>
                            <b>Comisión Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->comisionfumigacion }}%
                            </li>
                            <br>
                            <b>Distancia Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->distanciakm }} km
                            </li>
                            <br>
                            <b>Ltrs Gasolina:</b>
                            <li class="list-group-item">
                                {{ $unidade->ltrsgasolina }} Ltrs
                            </li>
                            <br>
                            <b>Status:</b>
                            <li class="list-group-item">
                                {{ $unidade->status }}
                            </li>
                            <br>
                        @endif
                        @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                            <b>Cliente:</b>
                            <li class="list-group-item">
                                {{ $unidade->cliente }}
                            </li>
                            <br>
                            <b>Codigo Postal:</b>
                            <li class="list-group-item">
                                {{ $unidade->cp }}
                            </li>
                            <br>
                            <b>Dirección:</b>
                            <li class="list-group-item">
                                {{ $unidade->direccion }}
                            </li>
                            <br>
                            <b>Calle:</b>
                            <li class="list-group-item">
                                {{ $unidade->calle }}
                            </li>
                            <br>
                            <b>Ciudad:</b>
                            <li class="list-group-item">
                                {{ $unidade->ciudad }}
                            </li>
                            <br>
                            <b>Responsable:</b>
                            <li class="list-group-item">
                                {{ $unidade->responsable }}
                            </li>
                            <br>
                            <b>Razon Social:</b>
                            <li class="list-group-item">
                                {{ $unidade->razonsocialunidad }}
                            </li>
                            <br>
                            <b>Vencimiento Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->lapsofumigacion }}
                            </li>
                            <br>
                            <b>Comisión Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->comisionfumigacion }}%
                            </li>
                            <br>
                            <b>Distancia Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->distanciakm }} km
                            </li>
                            <br>
                            <b>Ltrs Gasolina:</b>
                            <li class="list-group-item">
                                {{ $unidade->ltrsgasolina }} Ltrs
                            </li>
                            <br>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ $a }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ $a }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar la
                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                    Vivienda {{ $unidade->direccion }}
                                @endif
                                @if ($unidade->tipo == 'Unidad Vehicular')
                                    Unidad {{ $unidade->serieunidad }}
                                @endif
                                ?
                            </b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ $a }}').modal('hide')">
                    </div>
                    <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ $a }}').modal('hide')">
                                            NO</button>
                                        <button type="submit" class="btn btn-success">
                                            SI</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @php
            $a = $a . 'a';
        @endphp
    @endforeach
    {{-- =========================================== --}}
@endsection
