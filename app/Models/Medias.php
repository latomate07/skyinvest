<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'mediable_id', 'mediable_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mediable()
    {
        return $this->morphTo();
    }
}
