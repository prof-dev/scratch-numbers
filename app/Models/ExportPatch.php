<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportPatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_number',
        'company_id',
    ];

    protected $table = 'export_batches';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ScratchCodes()
    {
        return $this->hasMany(ScratchCode::class, 'id', 'export_batch_id');
    
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($exportPatch) {
            $exportPatch->scratchCodes()->delete();
        });
    }
    public function numberOfScratchCodes()
    {
        return ScratchCode::where('export_batch_id', $this->id)->get()->count();
    }

    public function hasUsed()
    {
        //check if there are any used scratch codes for this export batch
        return ScratchCode::where('export_batch_id', $this->id)->where('status', 1)->get()->isNotEmpty();
    }

    public function numberOfUsedWithType(String $type): int{
        return ScratchCode::where('export_batch_id', $this->id)->where('status', 1)->where('type', $type)->get()->count();
    }

    public function numberOfNotUsedWithType(String $type): int{
        return ScratchCode::where('export_batch_id', $this->id)->where('status', 0)->where('type', $type)->get()->count();
    }

    public function UsedWithType(String $type) : Collection {
        return ScratchCode::where('export_batch_id', $this->id)->where('status', 1)->where('type', $type)->get();
    }

    public function NotUsedWithType(String $type) : Collection {
        return ScratchCode::where('export_batch_id', $this->id)->where('status', 0)->where('type', $type)->get();
    }

    public function NotUsedWithTypesExcept(String $type) : Collection {
        return ScratchCode::where('export_batch_id', $this->id)->where('status', 0)->where('type', '!=' ,$type)->get();
    }

    public function getRouteKey()
    {
        return 'id';
    }
}
