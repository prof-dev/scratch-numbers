<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        return view(
            'batch_details',
            [
                'exportPatch' => $exportPatch,
                'company' => Company::findOrFail($exportPatch->company_id),
                'codes' => ScratchCode::where('export_batch_id', $exportPatch->id)->get(),
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
        // dd($exportPatch->hasUsed());
        //if this batch doesn't has used codes you can delete
        if(!$exportPatch->hasUsed()){
            $exportPatch->delete();
            return redirect()->back();
        }
        else{
            // else if it has used codes you cant delete it
            return redirect()->back()->withErrors(['batch_has_codes_'.$exportPatch->id => "Can't delete this export patch"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Http\Response
     */
    public function search(ExportPatch $exportPatch)
    {
        $validated = request()->validate([
            'search' => 'required'
        ]);
        // dd($exportPatch->id);
        // dd(ScratchCode::all()->first()->company());
        // dd(current_user()->company->id);
        $codes = ScratchCode::where('code', 'like', '%' . $validated['search'] . '%')
            ->orWhere('bar_code', 'like', '%' . $validated['search'] . '%')->get();

        $codes = $codes->filter(
            function ($value , $key){
                return $value->company() == current_user()->company->id;
            }
        );
        // dd($codes);
        if($codes->isEmpty()) {
            return view(
                'batch_details',
                [
                    'exportPatch' => $exportPatch,
                    'company' => Company::findOrFail($exportPatch->company_id),
                    'codes' => $codes,
                ]
            );
        }else{
            return redirect()->route('batch_details', $exportPatch->id)->withErrors(
                [
                    'search' => 'No batches found'
                ]
            );
        }
    }

}
