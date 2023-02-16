<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ClientesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Cliente::select(
            'nombrecompleto',
            'razonsocial',
            'telefono',
            'direccionfisica',
            'correo',
            'colonia',
            'ciudad',
            'municipio',
            'estado',
            'codigopostal',
            'rfc',
            'numero',
            'observaciones',
            'statuspago',
        )->get();
    }
    public function headings(): array
    {
        return [
            "NOMBRE COMPLETO",
            "RAZON SOCIAL",
            "TELEFONO", "DIRECCION FISICA", "CORREO", "COLONIA", "CIUDAD", "MUNICIPIO",
            "ESTADO", "CODIGO POSTAL", "RFC", "NUMERO", "OBSERVACIONES", "ESTATUS DE PAGO"
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->applyFromArray(array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '9dbad5')
            )
            ));
        return [


            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
           
            

           

        ];
    }
}
