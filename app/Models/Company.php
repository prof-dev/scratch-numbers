<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function exportBatches()
    {
        return $this->hasMany(ExportPatch::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scratchCodes()
    {
        return $this->hasManyThrough(ScratchCode::class, ExportPatch::class, 'company_id', 'export_batch_id');
    }
}
