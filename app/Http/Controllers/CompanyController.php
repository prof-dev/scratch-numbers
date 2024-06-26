<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ExportPatch;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! isIshraqAdmin()) {
            return view('home');
        }
        $companies = isIshraqAdmin() ? Company::all() : Company::where('id', current_user()->company_id)->get();

        return view('company', ['companies' => $companies]);
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
                'name' => 'required',
                'code' => 'required|unique:companies|string|size:3',
            ]
        );

        Company::create(
            [
                'name' => $validated['name'],
                'code' => $validated['code'],
            ]
        );

        return redirect()->route('company')->with('success', 'Company created.');
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
        //check if the resource exists
        if (ExportPatch::where('company_id', $id)->get()->isEmpty()) {
            //delete the resource from the database
            Company::where('id', $id)->delete();
            //redirect back to company view
            return redirect()->back();
        } else {
            // return with error messages
            return redirect()->route('company')->withErrors(['company_has_batches'.$id => 'Can\'t delete this company it has batches']);
        }
        // return
    }


    public function forceDelete(Request $request,$id)
    {
        if($request->confirmCode!="2024AAA"){
            return redirect()->route('company')->withErrors(['wrong_confirmation_code']);

        }
        $company=Company::where('id', $id)->first();

        if($company==null){
            return redirect()->route('company')->withErrors(['not_found']);

        }

        ExportPatch::where('company_id', $id)->delete();
        User::where('company_id', $id)->delete();
        $company->delete();
        return redirect()->back();
        
      
    }
}
