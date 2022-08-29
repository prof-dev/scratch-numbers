<?php

namespace App\Exports;

use App\Models\ScratchCode;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ScratchsExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    function array(): array
    {
        $scratches = ScratchCode::where('deleted_at', '=', null)->orderBy('id', 'DESC')->get();
        if ($scratches->isNotEmpty()) {

            foreach ($scratches as $scratch) {

                $item['code'] = $scratch->code;
                $item['status'] = $scratch->status;
                $item['batch'] = $scratch->scratch_batch_id;
                $item['type'] = $scratch->type;

                $data[] = $item;
            }
        } else {
            $data = [];
        }

        return $data;
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

    public function headings(): array
    {
        return [
            'Code',
            'status',
            'batch',
            'type',
        ];
    }
}
