@extends('layouts.app')
@section('title')
    Folios
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Folios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('folios.create') }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                {{-- <a class="btn btn-success" href="{{ route('operadores.export', $usuario) }}"><i
                                        class="fas fa-file-excel"></i></a> --}}
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                    <br><br>
                                <thead  style="background-color:#95b8f6">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Folio</th>
                                    <th style="color:#fff;">Tipo de Folio</th>
                                    {{-- <th style="color:#fff;">Fecha Creación</th> --}}
                                    <th style="color:#fff;">Folio Inicial</th>
                                    <th style="color:#fff;">Folio Actual</th>
                                    <th style="color:#fff;">Folio Final</th>
                                    <th style="color:#fff;">Folios Disponibles</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($folios as $folio)
                                        <tr>
                                            <td style="display: none;">{{ $folio->id }}</td>
                                            <td>{{ $folio->nombre }}</td>
                                            <td>{{ $folio->tipo }}</td>
                                            {{-- <td>{{ $folio->fecha_update }}</td> --}}
                                            <td>{{ $folio->folio }}</td>
                                            <td>
                                                @php
                                                    $string = $folio->folio;
                                                    $inicio = preg_replace('/[^0-9]/', '', $string);
                                                    $numeros = (int) $inicio + (int) $folio->contador;
                                                    if ($folio->tipo == 'Ambiental') {
                                                        echo $numeros;
                                                    }
                                                    if ($folio->tipo == 'Fisico-Mecanica-Arrastre') {
                                                        echo 'A-' . $numeros;
                                                    }
                                                    if ($folio->tipo == 'Fisico-Mecanica-Motriz') {
                                                        echo 'M-' . $numeros;
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ $folio->rango }}</td>
                                            {{--  --}}
                                            <td>
                                                @php
                                                    $string_1 = $folio->folio;
                                                    $inicial = preg_replace('/[^0-9]/', '', $string_1);
                                                    $string_2 = $folio->rango;
                                                    $final = preg_replace('/[^0-9]/', '', $string_2);
                                                    $numeros = (int) $final - (int) $inicial - (int) $folio->contador;
                                                    /* echo $numeros; */
                                                @endphp
                                                <h5>
                                                    @if ($numeros >= 50)
                                                        <span class="badge badge-primary">
                                                            {{ $numeros }}
                                                        </span>
                                                    @endif
                                                    @if ($numeros > 30 && $numeros < 50)
                                                        <span class="badge badge-success">
                                                            {{ $numeros }}
                                                        </span>
                                                    @endif
                                                    @if ($numeros > 10 && $numeros <= 30)
                                                        <span class="badge badge-warning">
                                                            {{ $numeros }}
                                                        </span>
                                                    @endif
                                                    @if ($numeros >= 1 && $numeros <= 10)
                                                        <span class="badge badge-danger">
                                                            {{ $numeros }}
                                                        </span>
                                                    @endif
                                                    @if ($numeros == 0)
                                                        <span class="badge badge-danger">
                                                            SIN FOLIOS
                                                        </span>
                                                    @endif
                                                </h5>
                                            </td>
                                            {{--  --}}
                                            {{-- ====================== --}}
                                            <td>
                                                <button type="submit" class="btn btn-sm" style="background-color: #9dbad5"
                                                    onclick="$('#edit{{ str_replace(' ', '', $folio->id) }}').modal('show')">
                                                    <i class="fas fa-pencil-alt" ></i></button>
                                                <button type="submit" class="btn btn-sm" style="background-color: #ff8097"
                                                    onclick="$('#delete{{ str_replace(' ', '', $folio->id) }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            {{-- ============================================================== --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($folios as $folio)
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ str_replace(' ', '', $folio->id) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar este Folio
                                {{ $folio->nombre }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
                    </div>
                    <form action="{{ route('folios.destroy', $folio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
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
        {{-- ===================== MODAL_EDITAR ===================== --}}
        <div class="modal fade" id="edit{{ str_replace(' ', '', $folio->id) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>
                                Folio:
                                {{ $folio->nombre }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#licencia{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
                    </div>
                    <form action="{{ route('folios.update', $folio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" class="form-control"
                                                    value="{{ $folio->nombre }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="fecha_update">Fecha de Registro</label>
                                                <input type="date" name="fecha_update" class="form-control"
                                                    value="{{ $folio->fecha_update }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="folio">Folio inicial</label>
                                                <input type="text" name="folio" class="form-control"
                                                    value="{{ $folio->folio }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="rango">Folio Final</label>
                                                <input type="text" name="rango" class="form-control"
                                                    value="{{ $folio->rango }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="contador">contador</label>
                                                <input type="text" name="contador" class="form-control"
                                                    value="{{ $folio->contador }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="tipo">Tipo De Folio</label>
                                                <select name="tipo" id="tipo" class=" selectsearch">
                                                    <option disabled value="">Selecciona el Tipo de Folio</option>
                                                    @if ($folio->tipo == 'Ambiental')
                                                        <option selected value="Ambiental">Ambiental</option>
                                                    @else
                                                        <option value="Ambiental">Ambiental</option>
                                                    @endif
                                                    @if ($folio->tipo == 'FFisico-Mecanica-Arrastre')
                                                        <option selected value="Fisico-Mecanica-Arrastre">Fisico-Mecanica
                                                            Arrastre</option>
                                                    @else
                                                        <option value="Fisico-Mecanica-Arrastre">Fisico-Mecanica
                                                            Arrastre</option>
                                                    @endif
                                                    @if ($folio->tipo == 'Fisico-Mecanica-Motriz')
                                                        <option selected value="Fisico-Mecanica-Motriz">Fisico-Mecanica
                                                            Motriz</option>
                                                    @else
                                                        <option value="Fisico-Mecanica-Motriz">Fisico-Mecanica
                                                            Motriz</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            GUARDAR</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#edit{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
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
@endsection
