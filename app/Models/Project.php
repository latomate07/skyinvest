<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'images',
        'location',
        'amount',
        'campaignTime',
        'minInvest',
        'profits_percentage',
        'ytbVideo',
        'docs',
        'type_return_on_investissment',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medias()
    {
        return $this->morphMany(Medias::class, 'mediable');
    }
    /**
     * Relation to ProjectLike
     */
    public function likes()
    {
        return $this->morphTo(ProjectLikes::class, 'likeable');
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if(is_null($project->user_id)) // To make ProjectSeeder works
            {
                $project->user_id = auth()->user()->id;
            }
        });
    }
}
