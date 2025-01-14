@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Servicio de Fumigación</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('fumigaciones.show', $unidad) }}">Regresar</a>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('fumigaciones.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numerofumigacion">Folio de Fumigación</label>
                                            <input type="text" name="numerofumigacion" class="form-control">
                                        </div>
                                    </div>
                                    {{-- MOSTRAR SI ES V O H --}}
                                    @if ($tipo == 'Unidad Habitacional o Comercial')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="unidad">Unidad Habitacional</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $unidad }}" readonly="readonly">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($tipo == 'Unidad Vehicular')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="unidad">Unidad Vehicular</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $unidad }}" readonly="readonly">
                                            </div>
                                        </div>
                                    @endif
                                    {{--  --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Unidad Perteneciente al Cliente:</label>
                                            <input type="text" class="form-control" value="{{ $pcliente }}"
                                                readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Cliente Con Domicilio de:</label>
                                            <input type="text" class="form-control" value="{{ $direccion }}"
                                                readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_fumigador">Fumigador</label>
                                            <select name="id_fumigador" id="id_fumigador" class=" selectsearch">
                                                <option disabled selected value="">Selecciona el Fumigador</option>
                                                @foreach ($fumigadores as $fumigadore)
                                                    <option value="{{ $fumigadore->nombrecompleto }}">
                                                        {{ $fumigadore->nombrecompleto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @php
                                        /* FECHA ACTUAL */
                                        $fecha_actual = date('Y-n-d');
                                    @endphp
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaprogramada">Fecha de Servicio</label>
                                            <input type="datetime-local" name="fechaprogramada" class="form-control"
                                                min="{{ date('Y-n-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaultimafumigacion">Fecha ultima fumigacion</label>
                                            <input type="text" name="fechaultimafumigacion" class="form-control"
                                                value="{{ $fecha_actual }}" readonly="readonly">
                                        </div>
                                    </div>
                                    {{-- MOSTRAR SI ES V O H --}}
                                    @if ($tipo == 'Unidad Habitacional o Comercial')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="lugardelservicio">Lugar de Servicio</label>
                                                <input type="text" name="lugardelservicio" class="form-control"
                                                    readonly="readonly" value='{{ $lugar }}'>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($tipo == 'Unidad Vehicular')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="lugardelservicio">Lugar de Servicio</label>
                                                <input type="text" name="lugardelservicio" class="form-control"
                                                    readonly="readonly" value='Centro Fumigador'>
                                            </div>
                                        </div>
                                    @endif
                                    {{--  --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <select name="tipo" id="tipo" class=" selectsearch">
                                                <option value="Por Confirmar" selected>Tipos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numerodevisitas">Numero de Visitas</label>
                                            <input type="text" name="numerodevisitas" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control" value="$">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="producto">Producto Utilizado</label>
                                            <select name="producto" id="producto" class=" selectsearch">
                                                <option value="Productos" selected>Productos</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- \\\\\\\\\\\ valor no PLAGAS \\\\\\\\\\\ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 card-deck" hidden>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="insectosvoladores" name="insectosvoladores">
                                                <label class="form-check-label" for="insectosvoladores">
                                                    Insectos Voladores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="insectosrastreros" name="insectosrastreros">
                                                <label class="form-check-label" for="insectosrastreros">
                                                    Insectos Rastreros
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="cucaracha" name="cucaracha">
                                                <label class="form-check-label" for="cucaracha">
                                                    Cucaracha (Ger/Ori/Ame)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="pulgas" name="pulgas">
                                                <label class="form-check-label" for="pulgas">
                                                    Pulgas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="mosca" name="mosca">
                                                <label class="form-check-label" for="mosca">
                                                    Mosca
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="chinches" name="chinches">
                                                <label class="form-check-label" for="chinches">
                                                    Chinches
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="aracnidos" name="aracnidos">
                                                <label class="form-check-label" for="aracnidos">
                                                    Aracnidos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="hormigas" name="hormigas">
                                                <label class="form-check-label" for="hormigas">
                                                    Hormigas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="termitas" name="termitas">
                                                <label class="form-check-label" for="termitas">
                                                    Termitas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="roedores" name="roedores">
                                                <label class="form-check-label" for="roedores">
                                                    Roedores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="alacranes" name="alacranes">
                                                <label class="form-check-label" for="alacranes">
                                                    Alacranes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="carcamo" name="carcamo">
                                                <label class="form-check-label" for="carcamo">
                                                    Carcamo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    {{-- \\\\\\\\\\\ PLAGAS \\\\\\\\\\\ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 card-deck">
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="insectosvoladores" name="insectosvoladores">
                                                <label class="form-check-label" for="insectosvoladores">
                                                    Insectos Voladores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="insectosrastreros" name="insectosrastreros">
                                                <label class="form-check-label" for="insectosrastreros">
                                                    Insectos Rastreros
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="cucaracha" name="cucaracha">
                                                <label class="form-check-label" for="cucaracha">
                                                    Cucaracha (Ger/Ori/Ame)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="pulgas" name="pulgas">
                                                <label class="form-check-label" for="pulgas">
                                                    Pulgas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="mosca" name="mosca">
                                                <label class="form-check-label" for="mosca">
                                                    Mosca
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="chinches" name="chinches">
                                                <label class="form-check-label" for="chinches">
                                                    Chinches
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="aracnidos" name="aracnidos">
                                                <label class="form-check-label" for="aracnidos">
                                                    Aracnidos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="hormigas" name="hormigas">
                                                <label class="form-check-label" for="hormigas">
                                                    Hormigas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="termitas" name="termitas">
                                                <label class="form-check-label" for="termitas">
                                                    Termitas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="roedores" name="roedores">
                                                <label class="form-check-label" for="roedores">
                                                    Roedores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="alacranes" name="alacranes">
                                                <label class="form-check-label" for="alacranes">
                                                    Alacranes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="carcamo" name="carcamo">
                                                <label class="form-check-label" for="carcamo">
                                                    Carcamo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class=" selectsearch">
                                                {{-- <option disabled value="">Selecciona un Status</option>
                                                <option value="En Proceso">En Proceso</option>
                                                <option value="Concluido">Concluido</option> --}}
                                                <option value="Por Confirmar" selected>Por Confirmar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control" rows="7"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
