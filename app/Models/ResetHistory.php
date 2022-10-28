<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetHistory extends Model
{
    use HasFactory;

    protected $fillables=[
        "user_name",
        "code",
        "consumed_by",
        "user_id",
        "company_id",
    ];
}
