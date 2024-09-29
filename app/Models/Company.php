<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'logo',
        'name',
        'address',
        'office_phone',
        'mobile_phone',
        'profile',
        'URL',
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function userHasCompany($userId)
    {
        return self::where('user_id', $userId)->exists();
    }
}
