<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use HasFactory, SoftDeletes;

    public const SECONDS_TO_EXPIRE = 2400; // 40 min

    protected $fillable = [
        'token',
        'expired_at'
    ];
}
