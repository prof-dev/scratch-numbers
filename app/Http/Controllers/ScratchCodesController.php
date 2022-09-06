<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ExportPatch;
use App\Models\ScratchCode;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class ScratchCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = ExportPatch::with('company')->get();
        $companies = Company::all();

        return view('scratch_codes_batches', ['batches' => $batches, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'number' => 'required|integer|min:1',
                'company' => 'required|integer',
                'type' => ['string', 'size:3', new Uppercase],
            ]
        );
        ScratchCode::generateCodes($validated['company'], $validated['number'], $validated['type']);
        // dd($validated);

        return redirect()->route('scratch_codes_batches');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScratchCode  $scratchCode
     * @return \Illuminate\Http\Response
     */
    public function show(ScratchCode $scratchCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScratchCode  $scratchCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScratchCode $scratchCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScratchCode  $scratchCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //00 success
        //01 used
        //02 notExist
        //03 notExistForType
        if($validated = $request->validate(
            [
                'Code' => 'required',
                'Type' => 'required'
            ]
        )){
            if($code = ScratchCode::withTrashed()->where('code', $validated['Code'])->first()){
                if(strcmp($code['type'], $validated['Type']) == 0){
                    if($code['deleted_at'] == null){
                        //softDeletes for the code
                        $code->delete();
                        //  code not used and success
                        return response([
                            'Code' => $validated['Code'],
                            'Type' => $validated['Type'],
                            'StatusCode' => '00'
                        ]);
                    }else{
                        //code is used
                        return response(
                            [
                                'Code' => $validated['Code'],
                                'Type' => $validated['Type'],
                                'StatusCode' => '01'
                            ]
                        );
                    }
                }else{
                    return response(
                        [
                        'Code' => $validated['Code'],
                        'Type' => $validated['Type'],
                        'StatusCode' => '03'
                        ]
                    );
                }
            }
            else {
                return response([
                    'Code' => $validated['Code'],
                    'Type' => $validated['Type'],
                    'StatusCode' => '02'
                ]);
            }
        }else{
            return response(['message' => 'Invalid']);
        }
        // ScratchCode::where()->get();
    }
}
