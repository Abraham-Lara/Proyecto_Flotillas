@php
    $cliente = strval($_POST['datos_unidad']);
    $cadena_1 = '<label for="filtrounid">Filtro Unidades</label>
        <select name="filtrounid" id="filtrounid" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" style="width:90%">';
    use App\Models\Unidade;
    $unidad = Unidade::where('cliente', '=', $cliente)
        ->get();
    if ($cliente == 'todos') {
        $cadena_1 = $cadena_1 . '<option selected value="todos">Todas Las Unidades</option>';
    } else {
        $cadena_1 = $cadena_1 . '<option value="todos">Todas Las Unidades</option>';
        foreach ($unidad as $unidade) {
            if ($unidade->tipo=='Unidad Vehicular') {
                $cadena_1 = $cadena_1 . '<option value="' . $unidade->id . '">' . strval($unidade->placas) . '</option>';
            }
            if ($unidade->tipo=='Unidad Habitacional o Comercial') {
                $cadena_1 = $cadena_1 . '<option value="' . $unidade->id . '">' . strval($unidade->direccion) . '</option>';
            }
        }
    }
    $cadena_1 = $cadena_1 . '</select>';
    echo $cadena_1;
@endphp
