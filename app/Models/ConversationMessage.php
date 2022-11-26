<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'conversations_messages';

    /**
     * Fillable attributs
     * 
     * @var array
     */
    protected $fillable = [
        'uid',
        'conversation_id',
        'from_id',
        'to_id',
        'message',
        'is_seen'
    ];

    /**
     * Get appropriate conversation
     * 
     * @return object
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get user that send the message
     * 
     * @return object 
     */
    public function sender()
    {
        return $this->hasOne(User::class, 'from_id');
    }

    /**
     * Get user that receive the message
     * 
     * @return object
     */
    public function receiver()
    {
        return $this->hasOne(User::class, 'to_id');
    }

    /**
     * Scope to find a message that seen
     */
    public function scopeIsSeen($query)
    {
        return $query->where('conversation_id', $this->conversation_id)->where('is_seen', 1);
    }
}
