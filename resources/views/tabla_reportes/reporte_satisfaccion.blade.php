@extends('layouts.app')
@section('title')
    REPORTE SATISFACCION
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Satisfacción Servicio Fumigación</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"
                                            dir="{{ route('tabla_reportes.reportes_satisfaccionexcel') }}">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                        <button type="submit" class="btn btn-danger"
                                            dir="{{ route('pdf.reportes_satisfaccionpdf') }}">
                                            <i class="fas fa-file-pdf"></i> PDF
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
                                @can('particular-rol')
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtrocli">Filtro Clientes:</label>
                                                    <input type="text" name="filtrocli" id="filtrocli" class="form-control"
                                                        value="{{ $clientes }}" readonly="readonly" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtrounid">Filtro Unidades</label>
                                                    <select name="filtrounid" id="filtrounid" readonly="readonly"
                                                        class=" selectsearch" style="width:100%">
                                                        <option selected value="todos">Todas Las Unidades</option>
                                                        @foreach ($unidades as $unidade)
                                                            <option value="{{ $unidade->id }}">{{ $unidade->serieunidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endcan
                                {{-- GENERAL --}}
                                @can('general-rol')
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="input-group">
                                                    <label class="label" for="filtrocli">Filtro Clientes</label>
                                                    <select name="filtrocli" id="filtrocli" {{-- class="selectsearch" --}}
                                                        class="form-select form-select-sm mb-3"
                                                        aria-label=".form-select-sm example" style="width:100%">
                                                        <option value="todos">Todos los Clientes</option>
                                                        @foreach ($clientes as $cliente)
                                                            <option value="{{ $cliente->nombrecompleto }}">
                                                                {{ $cliente->nombrecompleto }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="input-group" id="unidades_opciones">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endcan
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrotuni">Filtro Tipo de Unidad</label>
                                                <select name="filtrotuni" id="filtrotuni" class=" selectsearch"
                                                    style="width:100%">
                                                    <option selected value="Ambas">Ambas Unidades</option>
                                                    <option value="Habitacion">Habitacionales</option>
                                                    <option value="Vehiculo">Vehiculares</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                            <br>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Folio Fumigación</th>
                                    <th style="color:#fff;">Placas/Dirección</th>
                                    <th style="color:#fff;">Cliente</th>
                                    {{-- <th style="color:#fff;">Serie Unidad</th> --}}
                                    {{-- <th style="color:#fff;">Marca</th> --}}
                                    <th style="color:#fff;">Ultima Fumigación</th>
                                    <th style="color:#fff;">Fumigador</th>
                                    <th style="color:#fff;">Status Pago</th>
                                    <th style="color:#fff;">Dirección Fisica</th>
                                    <th style="color:#fff;">Razón Social</th>
                                    {{-- <th style="color:#fff;">Información</th> --}}

                                </thead>
                                <tbody>
                                    @foreach ($fumigaciones as $fumigacione)
                                        @php
                                            foreach ($unidades as $unidade) {
                                                if ($fumigacione->numerofumigacion == $unidade->fumigacion) {
                                                    echo '<tr>';
                                                        echo '<td>' . $fumigacione->numerofumigacion . '</td>';
                                                    if ($unidade->tipo == 'Unidad Vehicular') {
                                                        echo '<td>' . $unidade->placas . '</td>';
                                                    }
                                                    if ($unidade->tipo == 'Unidad Habitacional o Comercial') {
                                                        echo '<td>' . $unidade->direccion . '</td>';
                                                    }
                                                    echo '<td>' . $unidade->cliente . '</td>';
                                                    echo '<td>' . $fumigacione->fechaultimafumigacion . '</td>';
                                                    echo '<td>' . $fumigacione->id_fumigador . '</td>';
                                                    echo '<td>' . $fumigacione->status . '</td>';
                                                    foreach ($clientes as $cliente) {
                                                        if ($cliente->nombrecompleto == $unidade->cliente) {
                                                            echo '<td>' . $cliente->direccionfisica . '</td>';
                                                            echo '<td>' . $cliente->razonsocial . '</td>';
                                                            echo '</tr>';
                                                            break;
                                                        }
                                                    }
                                                    break;
                                                }
                                            }
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
@endsection
@section('scripts')
    <script type="text/javascript">
        /* ==================== AJAX_UNIDADES ==================== */
        function recargarLista() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('pdf.datos_unidades_ambas') }}",
                data: 'datos_unidad=' + $('#filtrocli').val(),
                success: function(r) {
                    $('#unidades_opciones').html(r);
                },
                error: function() {
                    alert("ERROR AL CARGAR UNIDADES");
                }
            });
        }
        /* =============================================== */
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            /* ------------------ CARGAR UNIDADES ------------------------------------------- */
            recargarLista();
            $('#filtrocli').change(function() {
                recargarLista();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("button[type=submit]").click(function(e) {
                e.preventDefault();
                var accion = $(this).attr('dir'),
                    $form = $(this).closest('form');
                if (typeof accion !== 'undefined') {
                    $form.attr('action', accion);
                }
                $form.submit();
            });
        });
    </script>
@endsection
