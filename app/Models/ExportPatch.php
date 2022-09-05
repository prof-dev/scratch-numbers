<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportPatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_number',
        'company_id'
    ];

    protected $table = 'export_batches';

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function ScratchCodes(){
        return $this->hasMany(ScratchCode::class);
    }

    public function numberOfScratchCodes(){
        return ScratchCode::where('export_batch_id',$this->id)->get()->count();
    }

    public function getRouteKey()
    {
        return 'id';
    }

}
