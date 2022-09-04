<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportPatch extends Model
{
    use HasFactory;

    protected $table = 'export_batches';

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function ScratchCodes(){
        return $this->hasMany(ScratchCode::class);
    }


}
