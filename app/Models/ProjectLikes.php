<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'like_by',
        'likeable_id', 
        'likeable_type',
        'is_liked'
    ];
    
    /**
     * Create a relation with project
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($project_like) {
            $project_like->like_by = auth()->user()->id;
        });
    }
}
