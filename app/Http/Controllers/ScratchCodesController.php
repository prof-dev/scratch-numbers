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
        
        if(current_user()->company==Company::where("name","IshraqGroup")->first()&&current_user()->role==1){
            $batches = ExportPatch::with('company')->get();
        $companies = Company::all();


        }
        else{
            $batches = ExportPatch::with('company')->where("company_id",current_user()->company_id)->get();
            $companies = Company::where("id",current_user()->company_id)->get();

        }

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
        //check validated request
        if($validated = $request->validate(
            [
                'Code' => 'required',
                'Type' => 'required'
            ]
        )){
            //check if the scratch code exists
            if($code = ScratchCode::withTrashed()->where('code', $validated['Code'])->first()){
                //check if it is from the same type
                if(strcmp($code['type'], $validated['Type']) == 0){
                    //check if it is used
                    if($code['deleted_at'] == null && $code['status'] == 0){
                        //softDeletes for the code
                        $code->delete();
                        //  code not used and success
                        return response([
                            'Code' => $validated['Code'],
                            'Type' => $validated['Type'],
                            'StatusCode' => '00',
                            'StatusMessage'=>'Success'
                        ]);
                    }else{
                        //code is used
                        return response(
                            [
                                'Code' => $validated['Code'],
                                'Type' => $validated['Type'],
                                'StatusCode' => '01',
                                'StatusMessage'=>'Code Already Used'
                            ]
                        );
                    }
                }else{
                    return response(
                        [
                        'Code' => $validated['Code'],
                        'Type' => $validated['Type'],
                        'StatusCode' => '03',
                        'StatusMessage'=>'not exist with selected type'
                        ]
                    );
                }
            }
            else {
                return response([
                    'Code' => $validated['Code'],
                    'Type' => $validated['Type'],
                    'StatusCode' => '02',
                    'StatusMessage'=>'Code Does Not Exist'
                ]);
            }
        }else{
            return response(['message' => 'Invalid']);
        }
        // ScratchCode::where()->get();
    }
}
