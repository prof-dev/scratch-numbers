<?php

namespace App\Exports;

use App\Models\ExportPatch;
use App\Models\ScratchCode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPatchsExport implements WithHeadings, FromCollection
{
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
            'status',
            'batch',
            'type',
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
            ]
        );

        return $codes;
    }
}
