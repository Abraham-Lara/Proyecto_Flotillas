@extends('layouts.app')
@section('title')
    REPORTE OPERADORES
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Individual Operador</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id='tablas-style' class="table table-striped mt-2">
                                <a class="btn btn-success"{{--  href="{{ route('unidades.export', $usuario) }}" --}}><i class="fas fa-file-excel"></i></a>
                               {{--  <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Nombre Operador</th>
                                    <th style="color:#fff;">No. Licencia</th>
                                    <th style="color:#fff;">Vencimiento Licencia</th>
                                    <th style="color:#fff;">Vencimiento Apto</th>
                                </thead>
                                <tbody>
                                    @foreach ($operadores as $operadore)
                                        <tr>
                                            <td>{{ $operadore->cliente }}</td>
                                            <td>{{ $operadore->nombreoperador }}</td>
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
