<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLikes extends Model
{
    use HasFactory;
    
    /**
     * Create a relation with project
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($project_like) {
            $project_like->user_id = auth()->user()->id;
        });
    }
}
