<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $fillable = [
        "favoritable_id",
        "favoritable_type",
        'target_id'
    ];

    /**
     * Use relation to this model
     */
    public function favoritable()
    {
        return $this->morphTo();
    }
}
