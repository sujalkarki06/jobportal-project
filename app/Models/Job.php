<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'type',
        'position',
        'description',
        'salary',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];
    function category()
    {
        return $this->belongsTo(Category::class);
    }

     function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->belongsToMany(User::class, 'applications');
    }
    
}
