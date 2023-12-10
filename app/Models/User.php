<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public const MAX_NAME_LENGTH = 60;
    public const MAX_EMAIL_LENGTH = 100;
    public const PHOTO_WIDTH = 70;
    public const PHOTO_HEIGHT = 70;
    public const PHOTOS_FOLDER = 'users';

    protected $fillable = [
        'name',
        'position_id',
        'email',
        'phone',
        'photo'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
