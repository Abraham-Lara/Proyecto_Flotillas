@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('title')
    REPORTE INDIVIDUAL
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Individual Operador</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <a class="btn btn-danger" href="{{ route('tabla_reportes.dashboard') }}">Regresar</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @php
                                use App\Models\Cliente;
                                $clientesf = Cliente::all();
                            @endphp
                            <form action="{{ route('tabla_reportes.reporte_individualexcel') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Filtro por Fechas</label>
                                                <div class="input-group">
                                                    <label for="filtrofechainicio" style="width:55%">Fecha Inicio</label>
                                                    <label for="filtrofechafinal" style="width:45%">Fecha Final</label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="date" name="filtrofechainicio" class="form-control"
                                                        style="width:40%">
                                                    <span id="boot-icon" class="bi bi-dash-square-fill"
                                                        style="font-size: 2rem; color: rgb(84, 84, 84);"></span>
                                                    <input type="date" name="filtrofechafinal" class="form-control"
                                                        style="width:40%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        {{--  <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrounidad">Filtro Tipo Unidades</label>
                                                <select name="filtrounidad" id="filtrounidad" class=" selectsearch"
                                                    style="width:80%">
                                                    <option selected value="Ambas">Ambas Unidadades</option>
                                                    <option value="Habitacional">Unidad Habitacional</option>
                                                    <option value="Vehicular">Unidad Vehicular</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrocli">Filtro Clientes</label>
                                                <select name="filtrocli" id="filtrocli" class=" selectsearch"
                                                    style="width:80%">
                                                    <option selected value="todos">Todos los Clientes</option>
                                                    @foreach ($clientesf as $cliente)
                                                        <option value="{{ $cliente->nombrecompleto }}">
                                                            {{ $cliente->nombrecompleto }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <table id='tablas-style' class="table table-striped mt-2" id="tabla">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Nombre Operador</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">No. Licencia</th>
                                    <th style="color:#fff;">Vencimiento Licencia</th>
                                    <th style="color:#fff;">Vencimiento Apto</th>
                                </thead>
                                <tbody>
                                    @foreach ($operadores as $operadore)
                                        <tr>
                                            <td>{{ $operadore->nombreoperador }}</td>
                                            <td>{{ $operadore->cliente }}</td>
                                            <td>{{ $operadore->nolicencia }}</td>
                                            <td>{{ $operadore->fechavencimientolicencia }}</td>
                                            <td>{{ $operadore->fechavencimientomedico }}</td>
                                            {{-- Boton MODAL --}}
                                            {{-- AQUI VA --}}

                                            {{--  --}}
                                        </tr>
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
@endsection
@section('scripts')
    <script src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#tablas-style').DataTable();
        });
    </script>
@endsection
