<?php

namespace App\Http\Controllers;

use App\Models\ScratchCode;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.home_dashboard');
    }

    public function groupByCompanyBetweenTwoDates(Request $request)
    {
        # code...
        $result=ScratchCode::where("type","SDN")->select(["count(id) as total","sum(status) as activated"])->groupBy("comanyId")->with("company")->get();
        dd($result);
        if(isset($request->dateFrom)&&isset($request->dateTo)){

        }
    }

    public function groupByDateWhereComanyIs(Request $request)
    {
        # code...
        $result=ScratchCode::where("type","SDN")->select(["count(id) as total","sum(status) as activated"])->groupBy("created_at")->with("company")->get();
        dd($result);
        if(isset($request->dateFrom)&&isset($request->dateTo)){

        }
    }
}
