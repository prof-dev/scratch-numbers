<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateRequest;
use App\Http\Resources\GenerateResponse;
use App\Models\Company;
use App\Models\ExportPatch;
use App\Models\ScratchCode;
use App\Models\User;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScratchCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(isIshraqAdmin()){
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


    public function generateJsonBatch(GenerateRequest $request)
    {

       $scratchCodes= ScratchCode::generateCodes(current_user()->company_id, $request->number, $request->type);
        // dd($validated);
        current_user()->destroyToken();
        return response()->json(["data"=>GenerateResponse::collection($scratchCodes)],200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScratchCode  $scratchCode
     * @return \Illuminate\Http\Response
     */
    // public function show(ScratchCode $scratchCode)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScratchCode  $scratchCode
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, ScratchCode $scratchCode)
    // {
    //     //
    // }

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
        $apiToken = $request->header('Authorization-Token');
        if($apiToken!=="3fXeVRRTYAg4KUaE6fGoSAcXsYqDtvfYPSWWgAiW"){
            return response()->json(["message"=>"UnAuthorized"],401);
        }
        if($validated = $request->validate(
            [
                'Code' => 'required',
                'Type' => 'required',
            ]
        )){
            //check if the scratch code exists
            if($code = ScratchCode::withTrashed()->where('code', $validated['Code'])->first()){
                //check if it is from the same type
                if(strcmp($code['type'], $validated['Type']) == 0){
                    //check if it is used
                    if( $code['status'] == 0){
                        //softDeletes for the code
                        $code->status=1;

                        $code->consumed_by=isset($request->Phone)?$request->Phone:"";

                        Log::channel('consumed_by')
                        ->info("Consumed code: " . isset($request->Phone)?$request->Phone:"no number available",
                        [
                            'Code' => $code->code,
                            'IP' => request()->ip(),
                            'Time' => now(),
                        ]
                        );

                        $code->update();
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

    /**
     * Search resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        // dd($request);
        // dd(current_user()->id); 2
        // dd(current_user()->company->id); 1
        $validated = request()->validate(
            [
                'search' => 'required'
            ]
        );

        $batches= ExportPatch::where('batch_number' , 'like' , '%'. $validated['search'] . '%')
        ->orWhere('created_at' , 'like' , '%'. $validated['search'] . '%')
        ->get();

        $companies = Company::where('name', 'like', "%" .$validated['search']. "%")->get();
        foreach ($companies as $company) {
            // dd($company->exportBatches);
            // $batches->concat($company->exportBatches);
            foreach ($company->exportBatches as $batch) {
                $batches->push($batch);
            }
        }

        $users = User::where('name', 'like', "%". $validated['search'] ."%" )->get();
        foreach ($users as $user){
            foreach ($user->getUserExportBatches() as $batch){
                $batches->push($batch);
            }
        }

        $batches = $batches->unique()->sortBy('created_at');
        // dd($batches);
        // dd($validated);
        // dd($batches);

        if($batches->isEmpty()){
            return redirect()->back()->withErrors(
                [
                    'search' => 'No batches found'
                ]
            );
        }
        else{
            return view('scratch_codes_batches', ['batches' => $batches, 'companies' => Company::all()]);
        }

    }

}
