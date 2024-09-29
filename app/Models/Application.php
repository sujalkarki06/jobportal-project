<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_id',
        'cover_letter',
        'attachment'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function job()
    {
        return $this->belongsTo(Job::class);
    }
}
