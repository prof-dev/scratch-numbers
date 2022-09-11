<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScratchCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'status',
        'export_batch_id',
    ];

    public function ExportPatch()
    {
        return $this->belongsTo('App\Models\ScratchCodeExport');
    }


    // method to generate a batch codes
    public static function generateCodes($company, $numberOfCodes, $type)
    {
        //find the company with this id
        $company = Company::find($company);

        //find the last batch for each company
        $lastBatch = ExportPatch::where('company_id', $company->id)->get()->last();
        // if the last batch is empty
        $number=$lastBatch==null?0: $lastBatch->batch_number;

        $batch = ExportPatch::create(
            [
                'user_id' => auth()->user()->id,
                'batch_number' => $number + 1,
                'company_id' => $company->id,
            ]
        );

        for ($i = 0; $i < $numberOfCodes; $i++) {
            //create one
            $code = ScratchCode::createOneCode($company);
            //add the code to the database
            ScratchCode::create(
                [
                    'code' => $code,
                    'type' => $type,
                    'status' => false,
                    'export_batch_id' => $batch->id,
                ]
            );
        }
    }

    // a method to create batch codes
    private static function createOneCode($company)
    {
        //create random number
        $number = mt_rand(100000, 999999);
        //concatenate the company code with the random number
        // to create the random code
        $code = $company->code.$number;

        //check if the code exists in the database
        if (ScratchCode::codeExists($code)) {
            //create new code if it does exist
            return ScratchCode::createOneCode($company);
        }

        return $code;
    }

    //find if the code exists in the database
    private static function codeExists($code)
    {
        //find a non used code for this company
        return ScratchCode::where('code', $code)->exists();
    }
}
