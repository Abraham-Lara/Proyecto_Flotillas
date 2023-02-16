@extends('layouts.app')
@section('title')
    Operadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Operadores de : {{ $usuario }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.index') }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('operadores.crear', $usuario) }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <a class="btn btn-md" style="background-color: #7caa98" href="{{ route('operadores.export', $usuario) }}"><i
                                        class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                    <br><br>
                                    <thead style="background-color:#95b8f6">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Operador</th>
                                    <th style="color:#fff;">Informacion</th>
                                    <th style="color:#fff;">Estado Vencimiento Medico</th>
                                    <th style="color:#fff;">Estado Vencimiento Licencia</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($operadores as $operadore)
                                        <tr>
                                            <td style="display: none;">{{ $operadore->id }}</td>
                                            <td>{{ $operadore->nombreoperador }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-sm" style="background-color: #9dbad5"
                                                    onclick="$('#{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                {{-- ===================== CALCULO_DE_FECHAS_MEDICO ===================== --}}
                                                @php
                                                    /* FECHA LICENCIA */
                                                    $vencimiento_dia = substr($operadore->fechavencimientomedico, 8, 2);
                                                    $vencimiento_mes = substr($operadore->fechavencimientomedico, 5, 2);
                                                    $vencimiento_año = substr($operadore->fechavencimientomedico, 0, 4);
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
                                                <h5>
                                                    @if ($mes_contador >= 9)
                                                        <span class="badge badge-primary"
                                                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $mes_contador }} meses
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                        <span class="badge badge-success"
                                                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $mes_contador }} meses
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                        <span class="badge badge-warning"
                                                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $mes_contador }} meses
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador == 1 && $uno == 'nulo')
                                                        @if ($calcular == 0)
                                                            <span class="badge badge-danger"
                                                                onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                                Expira en:
                                                                {{ $mes_contador }} mes
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger"
                                                                onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                                Expira en:
                                                                {{ $mes_contador }} mes
                                                                y {{ $calcular }} dias
                                                            </span>
                                                        @endif
                                                    @endif
                                                    @if ($mes_contador == 1 && $uno == 'uno')
                                                        <span class="badge badge-danger"
                                                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $dias_exactos }} dias
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador == 0 && $dias_exactos > 0)
                                                        <span class="badge badge-danger"
                                                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $dias_exactos }} dias
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                        <span class="badge badge-danger"
                                                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Médico experirado
                                                        </span>
                                                    @endif
                                                </h5>
                                            </td>
                                            {{-- ============================================================== --}}
                                            <td>
                                                {{-- ===================== CALCULO_DE_FECHAS_LICENCIAS ===================== --}}
                                                @php
                                                    /* FECHA LICENCIA */
                                                    $vencimiento_dia = substr($operadore->fechavencimientolicencia, 8, 2);
                                                    $vencimiento_mes = substr($operadore->fechavencimientolicencia, 5, 2);
                                                    $vencimiento_año = substr($operadore->fechavencimientolicencia, 0, 4);
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
                                                <h5>
                                                    @if ($mes_contador >= 9)
                                                        <span class="badge badge-primary"
                                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $mes_contador }} meses
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                        <span class="badge badge-success"
                                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $mes_contador }} meses
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                        <span class="badge badge-warning"
                                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $mes_contador }} meses
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador == 1 && $uno == 'nulo')
                                                        @if ($calcular == 0)
                                                            <span class="badge badge-danger"
                                                                onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                                Expira en:
                                                                {{ $mes_contador }} mes
                                                                y {{ $calcular }} dias
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger"
                                                                onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                                Expira en:
                                                                {{ $mes_contador }} mes
                                                            </span>
                                                        @endif
                                                    @endif
                                                    @if ($mes_contador == 1 && $uno == 'uno')
                                                        <span class="badge badge-danger"
                                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $dias_exactos }} dias
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador == 0 && $dias_exactos > 0)
                                                        <span class="badge badge-danger"
                                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Expira en:
                                                            {{ $dias_exactos }} dias
                                                        </span>
                                                    @endif
                                                    @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                        <span class="badge badge-danger"
                                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Licencia Expirada
                                                        </span>
                                                    @endif
                                                </h5>
                                            </td>
                                            {{-- ============================================================== --}}
                                            <td>
                                                <a class="btn btn-sm" style="background-color: #9dbad5"
                                                    href="{{ route('operadores.edit', $operadore->id) }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-sm"  style="background-color: #ff8097"
                                                    onclick="$('#delete{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{-- <div class="pagination justify-content-end">
                                {!! $operadores->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($operadores as $operadore)
        <div class="modal fade" id="{{ str_replace(' ', '', $operadore->nombreoperador) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $operadore->nombreoperador }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Fecha Nacimiento:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechanacimiento }}
                        </li>
                        <br>
                        <b>Numero de Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->nolicencia }}
                        </li>
                        <br>
                        <b>Tipo de Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->tipolicencia }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento Medico:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechavencimientomedico }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechavencimientolicencia }}
                        </li>
                        <br>
                        <b>cliente:</b>
                        <li class="list-group-item">
                            {{ $operadore->cliente }}
                        </li>
                        <br>
                        <b>Licencia:</b>
                        <li class="list-group-item">
                            <object type="application/pdf" data="{{ asset($operadore->licencia) }}"
                                style="width: 400px; height: 300px;">
                                ERROR (no puede mostrarse el objeto)
                            </object>
                        </li>
                        <br>
                        <b>Certificación:</b>
                        <li class="list-group-item">
                            <object type="application/pdf" data="{{ asset($operadore->curso) }}"
                                style="width: 400px; height: 300px;">
                                ERROR (no puede mostrarse el objeto)
                            </object>
                        </li>
                        <br>
                        <b>Examen Medico:</b>
                        <li class="list-group-item">
                            <object type="application/pdf" data="{{ asset($operadore->examenmedico) }}"
                                style="width: 400px; height: 300px;">
                                ERROR (no puede mostrarse el objeto)
                            </object>
                        </li>
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ str_replace(' ', '', $operadore->nombreoperador) }}" tabindex="-1"
            role="dialog" aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar al Operador
                                {{ $operadore->nombreoperador }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                    </div>
                    <form action="{{ route('operadores.destroy', $operadore->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
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
        {{-- ===================== MODAL_LICENCIA ===================== --}}
        <div class="modal fade" id="licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}" tabindex="-1"
            role="dialog" aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>
                                Licencia del operador
                                {{ $operadore->nombreoperador }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                    </div>
                    <form action="{{ route('operadores.update', $operadore->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="cliente">cliente</label>
                                                <input type="text" name="cliente" class="form-control"
                                                    value="{{ $operadore->cliente }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="nombreoperador">Nombre del Operador</label>
                                                <input type="text" name="nombreoperador" class="form-control"
                                                    value="{{ $operadore->nombreoperador }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                                <input type="date" name="fechanacimiento" class="form-control"
                                                    value="{{ $operadore->fechanacimiento }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="nolicencia">No Licencia</label>
                                                <input type="text" name="nolicencia" class="form-control"
                                                    value="{{ $operadore->nolicencia }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="tipolicencia">Tipo de Licencia</label>
                                                <select name="tipolicencia" id="tipolicencia" class=" selectsearch">
                                                    <option disabled selected value="">Selecciona el Tipo de Licencia
                                                    </option>
                                                    @if ($operadore->tipolicencia == 'Federal')
                                                        <option selected value="Federal">Federal</option>
                                                    @else
                                                        <option value="Federal">Federal</option>
                                                    @endif
                                                    @if ($operadore->tipolicencia == 'Estatal')
                                                        <option selected value="Estatal">Estatal</option>
                                                    @else
                                                        <option value="Estatal">Estatal</option>
                                                    @endif
                                                    {{-- <option value="No Pagado">No Pagado</option>
                                                    <option value="Pagado">Pagado</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="fechavencimientomedico">Fecha de Vencimiento Medico</label>
                                                <input type="date" name="fechavencimientomedico" class="form-control"
                                                    value="{{ $operadore->fechavencimientomedico }}"
                                                    min="{{ date('Y-n-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="fechavencimientolicencia">Fecha de Vencimiento Licencia</label>
                                                <input type="date" name="fechavencimientolicencia"
                                                    class="form-control"
                                                    value="{{ $operadore->fechavencimientolicencia }}"min="{{ date('Y-n-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="unidad">unidad</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $operadore->unidad }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="licenciaruta">licenciaruta</label>
                                                <input type="text" name="licenciaruta" class="form-control"
                                                    value="{{ $operadore->licencia }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="cursoruta">cursoruta</label>
                                                <input type="text" name="cursoruta" class="form-control"
                                                    value="{{ $operadore->curso }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="examenmedicoruta">examenmedicoruta</label>
                                                <input type="text" name="examenmedicoruta" class="form-control"
                                                    value="{{ $operadore->examenmedico }}">
                                            </div>
                                        </div>
                                        <br>
                                        {{-- ==================================================== SUBIR DOCUMENTOS ======================== --}}
                                        <div class="form">
                                            <div class="grid">
                                                {{-- LICENCIA --}}
                                                <div class="form-element">
                                                    <div class="from-group">
                                                        <input name="licencia" type="file"
                                                            id="licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}">
                                                        <label
                                                            for="licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}"
                                                            id="licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}-preview">
                                                            <object type="application/pdf"
                                                                data="{{ asset($operadore->licencia) }}"
                                                                style="width: 200px; height: 250px;">
                                                                ERROR (no puede mostrarse el objeto)
                                                            </object>
                                                            <div>
                                                                <span>+</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="form">
                                                        <label>Licencia</label>
                                                    </div>
                                                </div>
                                                {{-- CERTIFICADO --}}
                                                <div class="form-element"hidden>
                                                    <div class="from-group">
                                                        <input name="curso" type="file" id="curso">
                                                        <label for="curso" id="curso-preview">
                                                            <object type="application/pdf"
                                                                data="{{ asset($operadore->curso) }}"
                                                                style="width: 200px; height: 250px;">
                                                                ERROR (no puede mostrarse el objeto)
                                                            </object>
                                                            <div>
                                                                <span>+</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="from">
                                                        <label>Certificado</label>
                                                    </div>
                                                </div>
                                                {{-- EXAMEN MEDICO --}}
                                                <div class="form-element"hidden>
                                                    <div class="from-group">
                                                        <input name="examenmedico" type="file" id="examenmedico">
                                                        <label for="examenmedico" id="examenmedico-preview">
                                                            <object type="application/pdf"
                                                                data="{{ asset($operadore->examenmedico) }}"
                                                                style="width: 200px; height: 250px;">
                                                                ERROR (no puede mostrarse el objeto)
                                                            </object>
                                                            <div>
                                                                <span>+</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="form">
                                                        <label>Examen Medico</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <br>
                                        <br>
                                        <button type="submit" class="btn btn-primary">
                                            GUARDAR</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                                            CANCELAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ===================== MODAL_MEDICO ===================== --}}
        <div class="modal fade" id="medico{{ str_replace(' ', '', $operadore->nombreoperador) }}" tabindex="-1"
            role="dialog" aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>
                                Medico del operador
                                {{ $operadore->nombreoperador }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#medico{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                    </div>
                    <form action="{{ route('operadores.update', $operadore->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="cliente">cliente</label>
                                                <input type="text" name="cliente" class="form-control"
                                                    value="{{ $operadore->cliente }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="nombreoperador">Nombre del Operador</label>
                                                <input type="text" name="nombreoperador" class="form-control"
                                                    value="{{ $operadore->nombreoperador }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                                <input type="date" name="fechanacimiento" class="form-control"
                                                    value="{{ $operadore->fechanacimiento }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="nolicencia">No Licencia</label>
                                                <input type="text" name="nolicencia" class="form-control"
                                                    value="{{ $operadore->nolicencia }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="tipolicencia">Tipo de Licencia</label>
                                                <select name="tipolicencia" id="tipolicencia" class=" selectsearch">
                                                    <option disabled selected value="">Selecciona el Tipo de Licencia
                                                    </option>
                                                    @if ($operadore->tipolicencia == 'Federal')
                                                        <option selected value="Federal">Federal</option>
                                                    @else
                                                        <option value="Federal">Federal</option>
                                                    @endif
                                                    @if ($operadore->tipolicencia == 'Estatal')
                                                        <option selected value="Estatal">Estatal</option>
                                                    @else
                                                        <option value="Estatal">Estatal</option>
                                                    @endif
                                                    {{-- <option value="No Pagado">No Pagado</option>
                                                    <option value="Pagado">Pagado</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="fechavencimientomedico">Fecha de Vencimiento Medico</label>
                                                <input type="date" name="fechavencimientomedico" class="form-control"
                                                    value="{{ $operadore->fechavencimientomedico }}"
                                                    min="{{ date('Y-n-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12"hidden>
                                            <div class="form-group">
                                                <label for="fechavencimientolicencia">Fecha de Vencimiento Licencia</label>
                                                <input type="date" name="fechavencimientolicencia"
                                                    class="form-control"
                                                    value="{{ $operadore->fechavencimientolicencia }}"min="{{ date('Y-n-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="unidad">unidad</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $operadore->unidad }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="licenciaruta">licenciaruta</label>
                                                <input type="text" name="licenciaruta" class="form-control"
                                                    value="{{ $operadore->licencia }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="cursoruta">cursoruta</label>
                                                <input type="text" name="cursoruta" class="form-control"
                                                    value="{{ $operadore->curso }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="examenmedicoruta">examenmedicoruta</label>
                                                <input type="text" name="examenmedicoruta" class="form-control"
                                                    value="{{ $operadore->examenmedico }}">
                                            </div>
                                        </div>
                                        <br>
                                        {{-- ==================================================== SUBIR DOCUMENTOS ======================== --}}
                                        <div class="form">
                                            <div class="grid">
                                                {{-- LICENCIA --}}
                                                <div class="form-element"hidden>
                                                    <div class="from-group">
                                                        <input name="licencia" type="file"
                                                            id="licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}">
                                                        <label
                                                            for="licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}"
                                                            id="licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}-preview">
                                                            <object type="application/pdf"
                                                                data="{{ asset($operadore->licencia) }}"
                                                                style="width: 200px; height: 250px;">
                                                                ERROR (no puede mostrarse el objeto)
                                                            </object>
                                                            <div>
                                                                <span>+</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="form">
                                                        <label>Licencia</label>
                                                    </div>
                                                </div>
                                                {{-- CERTIFICADO --}}
                                                <div class="form-element"hidden>
                                                    <div class="from-group">
                                                        <input name="curso" type="file" id="curso">
                                                        <label for="curso" id="curso-preview">
                                                            <object type="application/pdf"
                                                                data="{{ asset($operadore->curso) }}"
                                                                style="width: 200px; height: 250px;">
                                                                ERROR (no puede mostrarse el objeto)
                                                            </object>
                                                            <div>
                                                                <span>+</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="from">
                                                        <label>Certificado</label>
                                                    </div>
                                                </div>
                                                {{-- EXAMEN MEDICO --}}
                                                <div class="form-element">
                                                    <div class="from-group">
                                                        <input name="examenmedico" type="file"
                                                            id="examenmedico_img{{ str_replace(' ', '', $operadore->nombreoperador) }}">
                                                        <label
                                                            for="examenmedico_img{{ str_replace(' ', '', $operadore->nombreoperador) }}"
                                                            id="examenmedico_img{{ str_replace(' ', '', $operadore->nombreoperador) }}-preview">
                                                            <object type="application/pdf"
                                                                data="{{ asset($operadore->examenmedico) }}"
                                                                style="width: 200px; height: 250px;">
                                                                ERROR (no puede mostrarse el objeto)
                                                            </object>
                                                            <div>
                                                                <span>+</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="form">
                                                        <label>Examen Medico</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <br>
                                        <br>
                                        <button type="submit" class="btn btn-primary">
                                            GUARDAR</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#licencia{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                                            CANCELAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- =========================================== --}}
    <script>
        //================================================ //BUG: IMAGE PREVIEW ========================================
        function previewBeforeUpload(id) {
            document.querySelector("#" + id).addEventListener("change", function(e) {
                if (e.target.files.length == 0) {
                    return;
                }
                let file = e.target.files[0];
                let url = URL.createObjectURL(file);
                document.querySelector("#" + id + "-preview div").innerText = file.name;
                document.querySelector("#" + id + "-preview object").data = url;
            });
        }
    </script>
    @foreach ($operadores as $operadore)
        <script>
            previewBeforeUpload("licencia_img{{ str_replace(' ', '', $operadore->nombreoperador) }}");
            previewBeforeUpload("examenmedico_img{{ str_replace(' ', '', $operadore->nombreoperador) }}");
        </script>
    @endforeach
@endsection
