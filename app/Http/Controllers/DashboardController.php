<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ExportPatch;
use App\Models\ScratchCode;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the first page of dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View{
        return view('admin.home_dashboard', [
            'companies' => Company::all(),
            'groups' => $this->groupByCompanyBetweenTwoDates(request())
        ]);
    }

    /**
     * Display the stats of the company
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function companyStats(Request $request) : View {
        // dd('hidden');
        $validated = $request->validate(
            [
                'company' => ['numeric', 'nullable'],
                'start_date' => ['date','nullable'],
                'end_date' => ['date','nullable']
            ]
        );

        // dd($validated);
        // dd(strtotime($validated['start_date']));
        // dd(date( 'Y-m-d 00:00:00' , strtotime($validated['start_date'])));
        $arrayOfGroups = collect($this->groupByCompanyBetweenTwoDates($validated));


        return view('admin.home_dashboard', [
            'companies' => Company::all(),
            'groups' => $arrayOfGroups
        ]);

    }

    private function groupByCompanyBetweenTwoDates($request): array
    {
        # code...
        // dd($request);
        if (isset($request['start_date']) && isset($request['end_date'])) {
            if (isset($request['company'])) {
                // dd($request);
                if (isset($request['start_date']) && isset($request['end_date'])) {
                    $localCodes = DB::table('scratch_codes')
                    ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
                    ->join('companies', 'companies.id', '=', 'export_batches.company_id')
                    ->select(
                        'companies.name as company_name',
                        DB::raw('count(scratch_codes.id) as total'),
                        DB::raw('sum(scratch_codes.status) as used_count'),
                    )
                        ->where('scratch_codes.type', "SDN")
                        ->where('companies.id', $request['company'])
                        ->whereBetween(
                            'scratch_codes.created_at',
                            [
                                date('Y-m-d 00:00:00', strtotime($request['start_date'])),
                                date('Y-m-d 00:00:00', strtotime($request['end_date']))
                            ]
                        )
                        ->groupBy('name')
                        ->get();

                    $InternationalCodes = DB::table('scratch_codes')
                    ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
                    ->join('companies', 'companies.id', '=', 'export_batches.company_id')
                    ->select('companies.name as company_name', DB::raw('count(scratch_codes.id) as total'), DB::raw('sum(scratch_codes.status) as used_count'))
                    ->where('scratch_codes.type', "INT")
                    ->where('companies.id', $request['company'])
                    ->whereBetween(
                        'scratch_codes.created_at',
                        [
                            date('Y-m-d 00:00:00', strtotime($request['start_date'])),
                            date('Y-m-d 00:00:00', strtotime($request['end_date']))
                        ]
                    )
                        ->groupBy('name')
                        ->get();
                    return $result = [
                        "local" => $localCodes,
                        "global" => $InternationalCodes
                    ];
                }
            }
            $localCodes = DB::table('scratch_codes')
            ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
            ->join('companies', 'companies.id', '=', 'export_batches.company_id')
            ->select(
                'companies.name as company_name',
                DB::raw('count(scratch_codes.id) as total'),
                DB::raw('sum(scratch_codes.status) as used_count'),
            )
                ->where('scratch_codes.type', "SDN")
                ->whereBetween(
                    'scratch_codes.created_at',
                    [
                        date('Y-m-d 00:00:00', strtotime($request['start_date'])),
                        date('Y-m-d 00:00:00', strtotime($request['end_date']))
                    ]
                )
                ->groupBy('name')
                ->get();

            $InternationalCodes = DB::table('scratch_codes')
            ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
            ->join('companies', 'companies.id', '=', 'export_batches.company_id')
            ->select('companies.name as company_name', DB::raw('count(scratch_codes.id) as total'), DB::raw('sum(scratch_codes.status) as used_count'))
            ->where('scratch_codes.type', "INT")
            ->whereBetween(
                'scratch_codes.created_at',
                [
                    date('Y-m-d 00:00:00', strtotime($request['start_date'])),
                    date('Y-m-d 00:00:00', strtotime($request['end_date']))
                ]
            )
                ->groupBy('name')
                ->get();
            return $result = [
                "local" => $localCodes,
                "global" => $InternationalCodes
            ];
        }
        if (isset($request['company']) && !isset($request['start_date']) && !isset($request['end_date'])) {
            $localCodes = DB::table('scratch_codes')
            ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
            ->join('companies', 'companies.id', '=', 'export_batches.company_id')
            ->select(
                'companies.name as company_name',
                DB::raw('count(scratch_codes.id) as total'),
                DB::raw('sum(scratch_codes.status) as used_count'),
            )
                ->where('scratch_codes.type', "SDN")
                ->where('companies.id', $request['company'])
                ->groupBy('name')
                ->get();

            $InternationalCodes = DB::table('scratch_codes')
            ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
            ->join('companies', 'companies.id', '=', 'export_batches.company_id')
            ->select('companies.name as company_name', DB::raw('count(scratch_codes.id) as total'), DB::raw('sum(scratch_codes.status) as used_count'))
            ->where('scratch_codes.type', "INT")
            ->where('companies.id', $request['company'])
            ->groupBy('name')
            ->get();
            return $result = [
                "local" => $localCodes,
                "global" => $InternationalCodes
            ];
        }
        // dd($request);
        $localCodes = DB::table('scratch_codes')
        ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
        ->join('companies', 'companies.id', '=', 'export_batches.company_id')
        ->select(
            'companies.name as company_name',
            DB::raw('count(scratch_codes.id) as total'),
            DB::raw('sum(scratch_codes.status) as used_count'),
        )
            ->where('scratch_codes.type', "SDN")
            ->groupBy('name')
            ->get();

        $InternationalCodes = DB::table('scratch_codes')
        ->join('export_batches', 'export_batches.id', '=', 'scratch_codes.export_batch_id')
        ->join('companies', 'companies.id', '=', 'export_batches.company_id')
        ->select('companies.name as company_name', DB::raw('count(scratch_codes.id) as total'), DB::raw('sum(scratch_codes.status) as used_count'))
        ->where('scratch_codes.type', "INT")
        ->groupBy('name')
        ->get();



        $result = [
            "local" => $localCodes,
            "global" => $InternationalCodes
        ];
        // dd($result);



        return $result;
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
