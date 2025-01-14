@extends('layouts.app')
@section('title')
    Fumigadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigadores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigadores.create') }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <a class="btn btn-md" style="background-color: #7caa98" href="{{ route('fumigadores.export') }}"><i
                                        class="fas fa-file-excel"></i></a>
                                        <br>
                                        <br>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead  style="background-color:#95b8f6">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Informacion</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($fumigadores as $fumigadore)
                                        <tr>
                                            <td style="display: none;">{{ $fumigadore->id }}</td>
                                            <td>{{ $fumigadore->nombrecompleto }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-md " style="background-color: #9dbad5"
                                                    onclick="$('#{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                <a class="btn btn-sm" style="background-color: #9dbad5"
                                                    href="{{ route('fumigadores.edit', $fumigadore->id) }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-sm" style="background-color: #ff8097"
                                                    onclick="$('#delete{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{--   <div class="pagination justify-content-end">
                                {!! $fumigadores->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($fumigadores as $fumigadore)
        <div class="modal fade" id="{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $fumigadore->nombrecompleto }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Fecha de Nacimiento:</b>
                        <li class="list-group-item">
                            {{ $fumigadore->fechanacimiento }}
                        </li>
                        <br>
                        <b>Certificado:</b>
                        <li class="list-group-item">
                            {{ $fumigadore->certificacion }}
                        </li>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}" tabindex="-1"
            role="dialog" aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar al Fumigador
                                {{ $fumigadore->nombrecompleto }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('hide')">
                    </div>
                    <form action="{{ route('fumigadores.destroy', $fumigadore->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('hide')">
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
    @endforeach
    {{-- =========================================== --}}
@endsection
