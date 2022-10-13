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
                            <a class="btn btn-warning" href="{{ route('unidades.crear', $usuario) }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">No. Serie</th>
                                    <th style="color:#fff;">Información Unidad</th>
                                    <th style="color:#fff;">Estado Seguro</th>
                                    <th style="color:#fff;">Estado Verificación</th>
                                    <th style="color:#fff;">Estado Mantenimiento</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td style="display: none;">{{ $unidade->id }}</td>
                                            <td>{{ $unidade->serieunidad }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                @if ($unidade->seguro == 'Sin Seguro')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->seguro }}</a></span>
                                                    </h5>
                                                @else
                                                    {{-- ===================== CALCULO_DE_FECHAS_MEDICO ===================== --}}
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
                                                        if ($diferencia_año >= 1) {
                                                            $meses = $diferencia_año * 12 + 12;
                                                            $operacion_1 = $meses - (int) $mes_actual;
                                                            $operacion_2 = 12 - (int) $vencimiento_mes;
                                                            $operacion_3 = $operacion_1 - $operacion_2;
                                                            $meses = $operacion_3;
                                                        } else {
                                                            $meses = (int) $vencimiento_mes - (int) $mes_actual;
                                                        }
                                                        if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                                            $uno = 'uno';
                                                        }
                                                        /* CALCULO DE DIAS EXACTOS */
                                                        $dias_exactos = 0;
                                                        $contador_1 = 0;
                                                        $contador_2 = 0;
                                                        $cuenta_mes = $mes_actual;
                                                        $operacion_1 = 0;
                                                        $mes_contador = 0;
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
                                                        $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                                        $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                                        $calcular = $direstantes + (int) $vencimiento_dia;
                                                        $dias_resto = $calcular;
                                                        $opc = 2;
                                                        for ($i = 0; $i <= $opc; $i++) {
                                                            if ($calcular >= 30) {
                                                                $mes_contador = $mes_contador + 1;
                                                                $calcular = $calcular - 29;
                                                            }
                                                        }
                                                    @endphp
                                                    {{-- ============================================================== --}}
                                                    {{-- ========================== IF PARA MOSTRAR =================== --}}
                                                    <h5>
                                                        @if ($mes_contador >= 9)
                                                            <span class="badge badge-primary">
                                                                <a class="link-light"
                                                                    href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                    en:
                                                                    {{ $mes_contador }} meses</a>
                                                            </span>
                                                        @endif
                                                        @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                            <span class="badge badge-success">
                                                                <a class="link-light"
                                                                    href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                    en:
                                                                    {{ $mes_contador }} meses</a>
                                                            </span>
                                                        @endif
                                                        @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                            <span class="badge badge-warning">
                                                                <a class="link-light"
                                                                    href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                    en:
                                                                    {{ $mes_contador }} meses</a>
                                                            </span>
                                                        @endif
                                                        @if ($mes_contador == 1 && $uno == 'nulo')
                                                            <span class="badge badge-danger">
                                                                <a class="link-light"
                                                                    href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                    en:
                                                                    {{ $mes_contador }} mes
                                                                </a> </span>
                                                        @endif
                                                        @if ($mes_contador == 1 && $uno == 'uno')
                                                            <span class="badge badge-danger">
                                                                <a class="link-light"
                                                                    href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">Expira
                                                                    en:
                                                                    {{ $dias_exactos }} dias
                                                                </a> </span>
                                                        @endif
                                                    </h5>












































                                                @endif
                                            </td>
                                            {{-- ============================================================== --}}
                                            <td>
                                                @if ($unidade->verificacion == 'Sin Verificación')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->verificacion }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->verificacion == 'Con Verificación')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->verificacion }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->mantenimiento }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->mantenimiento == 'Con Mantenimiento')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('mantenimientos.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->mantenimiento }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('unidades.edit', $unidade->id) }}">
                                                    <i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger"
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
                            <div class="pagination justify-content-end">
                                {!! $unidades->links() !!}
                            </div>
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
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $unidade->serieunidad }}</b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
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
                        <b>Placas:</b>
                        <li class="list-group-item">
                            {{ $unidade->placas }}
                        </li>
                        <br>
                        <b>Status:</b>
                        <li class="list-group-item">
                            {{ $unidade->status }}
                        </li>
                        <br>
                        <b>Cliente:</b>
                        <li class="list-group-item">
                            {{ $unidade->cliente }}
                        </li>
                        <br>
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
                                Eliminar la Unidad
                                {{ $unidade->serieunidad }}?</b></h5>
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
