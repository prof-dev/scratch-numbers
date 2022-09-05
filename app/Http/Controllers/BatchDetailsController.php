<?php

namespace App\Http\Controllers;

use App\Models\ExportPatch;
use App\Models\ScratchCode;
use Illuminate\Http\Request;

class BatchDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Http\Response
     */
    public function show(ExportPatch $exportPatch)
    {
        // dd(ExportPatch::with('ScratchCodes')->get());
        // dd(ScratchCode::where('export_batch_id', $exportPatch->id)->get());
        // dd($exportPatch);
        return view(
            'batch_details',
            [
                'exportPatch' => $exportPatch,
                'codes' => ScratchCode::where('export_batch_id', $exportPatch->id)->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Http\Response
     */
    public function edit(ExportPatch $exportPatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExportPatch $exportPatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExportPatch $exportPatch)
    {
        //
    }
}
