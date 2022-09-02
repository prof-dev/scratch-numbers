<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id'
    ];

    protected $table = 'roles';

    public $timestamps = false;

    public const IS_ADMIN = 1;
    public const IS_USER = 2;
    public const IS_COMPANY = 3;

}
