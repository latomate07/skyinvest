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

    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class);
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->user_id = auth()->user()->id;
        });
    }
}
