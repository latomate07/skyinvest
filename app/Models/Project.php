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
        'type_return_on_investissment'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
