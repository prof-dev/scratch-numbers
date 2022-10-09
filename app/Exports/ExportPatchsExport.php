<?php

namespace App\Exports;

use App\Models\ExportPatch;
use App\Models\ScratchCode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportPatchsExport implements WithHeadings, FromCollection, ShouldAutoSize, WithEvents
{

    // need to be revised
    protected $batch_id;

    public function __construct(int $batch_id)
    {
        // $this->batch = $batch;
        $this->batch_id = $batch_id;
    }

    /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function array(): array
    // {
    //     // return ExportPatch::all();
    //     return $this->batch;

    // }
    public function headings(): array
    {
        return [
            'Code',
            'consume',
            'batch',
            'type',
            'activated for'
            
        ];
    }

    public function collection()
    {
        $codes = ScratchCode::where('export_batch_id', $this->batch_id)->where('deleted_at', '=', null)
        ->get(
            [
                'code',
                'status',
                'export_batch_id',
                'type',
                'consumed_by'
            ]
        );

        return $codes;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ];
            },
        ];
    }
}
