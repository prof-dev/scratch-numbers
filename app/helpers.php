<?php

use App\Models\Company;

function current_user()
{
    return auth()->user();
}


function isIshraqAdmin(){
    // dd(auth()->user()->company==Company::where("name","IshraqGroup")->first()&&current_user()->role_id==2);
    
    return auth()->user()->company==Company::where("name","IshraqGroup")->first()&&current_user()->role_id==2;
}