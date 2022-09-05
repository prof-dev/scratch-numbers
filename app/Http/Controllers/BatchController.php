<?php

namespace App\Http\Controllers;

use App\Exports\ExportPatchsExport;
use App\Models\ExportPatch;
use App\Models\ScratchCode;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BatchController extends Controller
{

    public function export(ExportPatch $exportPatch)
    {
        $codes = ScratchCode::where('export_batch_id',$exportPatch->id)->where('deleted_at', '=', null)
        ->get(
            [
                'code',
                'status',
                'export_batch_id',
                'type'
            ]
            );
        if($codes->isNotEmpty()){
            $export = new ExportPatchsExport([
                $codes
            ]);
            return Excel::download($export, 'Clients.xlsx');
        }
        return redirect()->route('scratch_codes_batches');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
