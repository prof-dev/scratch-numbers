<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ExportPatch;
use App\Models\ScratchCode;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the first page of dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View{
        return view('admin.home_dashboard', [
            'companies' => Company::all()
        ]);
    }

    /**
     * Display the stats of the company
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function companyStats(Request $request) : View {
        $validated = $request->validate(
            [
                'company' => ['required', 'numeric'],
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date']
            ]
        );

        // dd($validated['start_date']);
        // dd(strtotime($validated['start_date']));
        // dd(date( 'Y-m-d 00:00:00' , strtotime($validated['start_date'])));
        return $this->groupByCompanyBetweenTwoDates($validated);

    }

    private function groupByCompanyBetweenTwoDates(array $request) : View
    {
        # code...
        // dd($request);
        // $result=ScratchCode::where("type","SDN")->select(["count(id) as total","sum(status) as activated"])->groupBy("company_id")->with("company")->get();
        $exportPatchesWithCompanyName = ExportPatch::where("company_id",$request['company'])->get();
        $resultNotUsedWithTypeSDN = $this->getNotUsedWithTypeSDN($exportPatchesWithCompanyName, $request);
        $resultNotUsedWithOtherTypes = $this->getNotUsedWithOtherTypes($exportPatchesWithCompanyName, $request);

        $countInternational = $this->getCountInternational($exportPatchesWithCompanyName, $request);

        // dd($resultNotUsedWithOtherTypes);

        // if(isset($request->dateFrom)&&isset($request->dateTo)){

        // }

        return view('admin.home_dashboard', [
            'companies' => Company::all(),
            'company' => Company::find($request['company']),
            'local_used' => $resultNotUsedWithTypeSDN,
            'international_used' => $resultNotUsedWithOtherTypes,
            // 'international_codes_count' =>
        ]);
    }


    private function getNotUsedWithOtherTypes(EloquentCollection $exportPatchesWithCompanyName , array $request){
        $resultNotUsedWithOtherTypes = collect();
        foreach($exportPatchesWithCompanyName as $exportPatch){
            $resultNotUsedWithOtherTypes =
            $resultNotUsedWithOtherTypes->concat(
                $exportPatch->NotUsedWithTypesExcept("SDN")
                ->whereBetween(
                    'created_at',
                    [
                        date( 'Y-m-d 00:00:00' , strtotime($request['start_date'])),
                        date('Y-m-d 00:00:00' , strtotime($request['end_date']))
                    ]
                )
            );
        }

        return $resultNotUsedWithOtherTypes;
    }

    private function getNotUsedWithTypeSDN(EloquentCollection $exportPatchesWithCompanyName , array $request ): Collection{
        $resultNotUsedWithType = collect();
        foreach($exportPatchesWithCompanyName as $exportPatch){
            $resultNotUsedWithType =
            $resultNotUsedWithType->concat(
                $exportPatch->NotUsedWithType("SDN")
                ->whereBetween(
                    'created_at',
                    [
                        date( 'Y-m-d 00:00:00' , strtotime($request['start_date'])),
                        date('Y-m-d 00:00:00' , strtotime($request['end_date']))
                    ]
                )
            );
        }

        return $resultNotUsedWithType;
    }

    private function groupByDateWhereCompanyIs(Request $request)
    {
        # code...
        $result=ScratchCode::where("companyId",$request->companyId)->where("type","SDN")->select(["count(id) as total","sum(status) as activated"])->groupBy("created_at")->with("company")->get();
        dd($result);

    }

}
