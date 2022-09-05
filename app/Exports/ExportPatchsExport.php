<?php

namespace App\Exports;

use App\Models\ExportPatch;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPatchsExport implements FromArray ,WithHeadings
{
    protected $batch;

    public function __construct(array $batch){
        $this->batch = $batch;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        // return ExportPatch::all();
        return $this->batch;

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
