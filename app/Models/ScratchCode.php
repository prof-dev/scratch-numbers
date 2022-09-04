<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScratchCode extends Model
{
    use HasFactory;

    public function ExportPatch(){
        return $this->hasOne('App\Models\ScratchCodeExport');
    }
}
