@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigaciones de {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.show', $usuario = $unidad) }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigaciones.crear', $unidad) }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <a class="btn btn-md" style="background-color: #7caa98" href="{{ route('fumigaciones.export') }}"><i
                                        class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <br><br>
                                <thead style="background-color:#95b8f6">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Folio Fumigación</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($fumigaciones as $fumigacione)
                                        <tr>
                                            <td style="display: none;">{{ $fumigacione->id }}</td>
                                            <td>{{ $fumigacione->numerofumigacion }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                @if ($fumigacione->status == 'En Proceso')
                                                    <span class="badge badge-warning">{{ $fumigacione->status }}</span>
                                                    
                                                @endif
                                                @if ($fumigacione->status == 'Concluido')
                                                    <span class="badge badge-success">{{ $fumigacione->status }}</span>
                                                    
                                                @endif
                                                @if ($fumigacione->status == 'Por Confirmar')
                                                    <span class="badge badge-warning">{{ $fumigacione->status }}</span>
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm"  style="background-color: #9dbad5"
                                                    href="{{ route('fumigaciones.edit', $fumigacione->id) }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-sm"  style="background-color: #ff8097"
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
    @foreach ($fumigaciones as $fumigacione)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>
                                Información del Folio de Fumigación: {{ $fumigacione->numerofumigacion }}</b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Unidad:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->unidad }}
                        </li>
                        <br>
                        <b>Fumigador:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->id_fumigador }}
                        </li>
                        <br>
                        <b>Fecha De Fumigación:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->fechaprogramada }}
                        </li>
                        <br>
                        <b>Fecha de la Ultima Fumigaciòn:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->fechaultimafumigacion }}
                        </li>
                        <br>
                        <b>Lugar del Servicio:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->lugardelservicio }}
                        </li>
                        <br>
                        <b>Numero de Visitas:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->numerodevisitas }}
                        </li>
                        <br>
                        <b>Costo:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->costo }}
                        </li>
                        <br>
                        <b>Producto Utilizado:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->producto }}
                        </li>
                        <br>
                        <b>Tipo:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->tipo }}
                        </li>
                        <br>
                        <b>Bichos Fumigados:</b>
                        <div class="card-deck">
                            <div class="card">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->insectosvoladores == 'Si') checked @endif id="insectosvoladores"
                                        name="insectosvoladores">
                                    <label class="form-check-label" for="insectosvoladores">
                                        Insectos Voladores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->insectosrastreros == 'Si') checked @endif id="insectosrastreros"
                                        name="insectosrastreros">
                                    <label class="form-check-label" for="insectosrastreros">
                                        Insectos Rastreros
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->cucaracha == 'Si') checked @endif id="cucaracha" name="cucaracha">
                                    <label class="form-check-label" for="cucaracha">
                                        Cucaracha (Ger/Ori/Ame)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->pulgas == 'Si') checked @endif id="pulgas" name="pulgas">
                                    <label class="form-check-label" for="pulgas">
                                        Pulgas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->mosca == 'Si') checked @endif id="mosca" name="mosca">
                                    <label class="form-check-label" for="mosca">
                                        Mosca
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->chinches == 'Si') checked @endif id="chinches" name="chinches">
                                    <label class="form-check-label" for="chinches">
                                        Chinches
                                    </label>
                                </div>
                            </div>
                            <div class="card">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->aracnidos == 'Si') checked @endif id="aracnidos" name="aracnidos">
                                    <label class="form-check-label" for="aracnidos">
                                        Aracnidos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->hormigas == 'Si') checked @endif id="hormigas"name="hormigas">
                                    <label class="form-check-label" for="hormigas">
                                        Hormigas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->termitas == 'Si') checked @endif id="termitas" name="termitas">
                                    <label class="form-check-label" for="termitas">
                                        Termitas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->roedores == 'Si') checked @endif id="roedores" name="roedores">
                                    <label class="form-check-label" for="roedores">
                                        Roedores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->alacranes == 'Si') checked @endif id="alacranes"
                                        name="alacranes">
                                    <label class="form-check-label" for="alacranes">
                                        Alacranes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->carcamo == 'Si') checked @endif id="carcamo" name="carcamo">
                                    <label class="form-check-label" for="carcamo">
                                        Carcamo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <b>Observaciones:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->observaciones }}
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
        {{-- ========================================================== --}}
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ $a }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar la Fumigación
                                {{ $fumigacione->numerofumigacion }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ $a }}').modal('hide')">
                    </div>
                    <form action="{{ route('fumigaciones.destroy', $fumigacione->id) }}"method="POST">
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
