<?php

namespace App\Exports;

use App\Models\Fumigacione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FumigacionesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Fumigacione::select(
            'id_cliente',
            'id_fumigador',
            'fechaprogramada',
            'fechaultimafumigacion',
            'lugardelservicio',
            'numerodevisitas',
            'costo',
            'status',
            'satisfaccionservicio'
        )->get();
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "FUMIGADOR",
            "FECHA PROGRAMADA", "FECHA DE ULTIMA FUMIGACION", "LUGAR DEL SERVICIO",
            "NUMERO DE VISITAS", "COSTO", "ESTADO",
            "SATISFACCIÓ DEL SERVICIO"
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
