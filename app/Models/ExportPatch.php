<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportPatch extends Model
{
    use HasFactory;

    protected $table = 'export_batches';
}
