@extends('layouts.app')
@section('title')
    Seguros
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Seguro</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger"
                                href="{{ route('unidades.show', $unidad = $seguro->id_unidad) }}">Regresar</a>
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
                            @php
                                /* FECHA ACTUAL */
                                $fecha_actual = date('Y-n-d');
                            @endphp
                            <form action="{{ route('seguros.update', $seguro->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- ========================================= OCULTOS ========================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="id_unidad">id_unidad</label>
                                        <input type="text" name="id_unidad" class="form-control"
                                            value="{{ $seguro->id_unidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="estado">estado</label>
                                        <input type="text" name="estado" class="form-control"
                                            value="{{ $seguro->estado }}">
                                    </div>
                                </div>
                                {{-- ========================================================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nopoliza">No. Poliza</label>
                                        <input type="text" name="nopoliza" class="form-control"
                                            value="{{ $seguro->nopoliza }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechainicio">Fecha de Inicio</label>
                                        <input type="date" name="fechainicio" class="form-control"
                                            value="{{ $seguro->fechainicio }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechavencimiento">Fecha de Vencimiento</label>
                                        <input type="date" name="fechavencimiento" class="form-control"
                                            value="{{ $seguro->fechavencimiento }}" min="{{ $fecha_actual }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tiposeguro">Tipo de Seguro</label>
                                        <input type="text" name="tiposeguro" class="form-control"
                                            value="{{ $seguro->tiposeguro }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="provedor">Proveedor</label>
                                        <input type="text" name="provedor" class="form-control"
                                            value="{{ $seguro->provedor }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="text" name="precio" class="form-control"
                                            value="{{ $seguro->precio }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="impuestos">Impuestos</label>
                                        <input type="text" name="impuestos" class="form-control"
                                            value="{{ $seguro->impuestos }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="costototal">Costo Total</label>
                                        <input type="text" name="costototal" class="form-control"
                                            value="{{ $seguro->costototal }}">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="form">
                                    <div class="grid">
                                        {{-- caratulaseguro --}}
                                        <div class="form-element">
                                            <div class="from-group">
                                                <input name="caratulaseguro" type="file" id="caratulaseguro">
                                                <label for="caratulaseguro" id="caratulaseguro-preview">
                                                    <object type="application/pdf"
                                                        data="{{ asset($seguro->caratulaseguro) }}"
                                                        style="width: 200px; height: 250px;">
                                                        ERROR (no puede mostrarse el objeto)
                                                    </object>
                                                    <div>
                                                        <span>+</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="form">
                                                <label>Caratula</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        previewBeforeUpload("caratulaseguro");
    </script>
@endsection
